<?php

namespace App\Http\Controllers\Frontend;

use App\Events\PaymentConfirmed;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Services\Midtrans\Facades\Midtrans;
use App\Services\Midtrans\Notification;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        /**
         * @var Notification $midtransNotification
         */
        $midtransNotification = Midtrans::notification();
        $notification = $midtransNotification->toObject();

        // $notification = $request;
        $verified = $this->verifyNotification($notification);
        if ($verified) {
            // $midtransNotification->onCapture(function () use ($notification) {
            //     $this->createPayment();
            //     $this->updateTransaction()
            // })->onSettlement(function () use ($notification) {
            // })->onPending(function () use ($notification) {
            // })->onDeny(function () use ($notification) {
            // })->onExpire(function () use ($notification) {
            // })->onCancel(function () use ($notification) {
            // });

            $notifTransactionStatus = $notification->transaction_status;
            $fraud = $notification->fraud_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $amount = $notification->gross_amount;

            $transaction = Transaction::where('code', $orderId)->firstOrDie();

            $payment = Payment::where('transaction_code',$transaction->code)->first();

            if (!empty($notification->va_numbers[0])) {
                $payment->va = $notification->va_numbers[0]->va_number;
                $payment->bank = $notification->va_numbers[0]->bank;
            }
            if(!empty($notification->biller_code) || !empty($notification->bill_key)){
                $payment->biller_code = $notification->biller_code;
                $payment->bill_key = $notification->bill_key;
            }
            if ($notifTransactionStatus == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                        $payment->status = Payment::STATUS_CHALLENGED;
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        $payment->status = Payment::STATUS_SUCCESS;
                    }
                }
            } elseif ($notifTransactionStatus == 'settlement') {
                // TODO set payment status in merchant's database to 'Settlement'
                $payment->status = Payment::STATUS_SETTLEMENT;
            } elseif ($notifTransactionStatus == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
                $payment->status = Payment::STATUS_PENDING;
            } elseif ($notifTransactionStatus == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
                $payment->status = Payment::STATUS_DENY;
            } elseif ($notifTransactionStatus == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                $payment->status = Payment::STATUS_EXPIRE;
            } elseif ($notifTransactionStatus == 'cancel') {
                // TODO set payment status in merchant's database to 'Denied'
                $payment->status =Payment::STATUS_CANCEL;
            }

            DB::transaction(function () use($payment, $transaction){
                $payment->save();
                if($payment->status === Payment::STATUS_SETTLEMENT || $payment->status === Payment::STATUS_SUCCESS){
                    $transaction->payment_status = Transaction::PAYMENT_STATUS_PAID;
                    $transaction->status = Transaction::STATUS_CONFIRMED;

                }
                $transaction->save();
                PaymentConfirmed::dispatch($payment);
            });


        }
    }

    public function create(Request $request)
    {
            $user = auth()->user();

            $carbon = Carbon::now();
            $cart = [];

            Cart::session($user->getAuthIdentifier())->getContent()->each(function($item) use (&$cart){
                $cart[] = $item;
            });
            DB::transaction(function() use ($user, $cart, $carbon){
                $transaksi = $this->setupTransaction($user, $cart, $carbon);

                $items = $this->setupDetailTransaction($transaksi, $cart);

               $snapPayload =  $this->setupSnapPayload( $transaksi, $user, $items);

              $snap =  Midtrans::createTransaction($snapPayload);

              $transaksi->payment_token = $snap->snap_token;
              $transaksi->payment_url = $snap->redirect_url;
              $transaksi->save();
              Cart::clear();


                return(redirect($snap->redirect_url));
            });

            //TODO: RETURN KE CART KARENA GAGAL





    }

    public function finish(Request $request)
    {
        return redirect('frontend.index');
    }

    public function unfinish(Request $request){
        return redirect('frontend.index');
    }

    public function error(Request $request)
    {
        return redirect('frontend.index');
    }

    private function verifyNotification(Notification $notification)
    {
          $orderId = $notification->order_id;
        $statusCode = $notification->status_code;
        $grossAmount = $notification->gross_amount;
        $serverKey = config('midtrans.server_key');
        $hash = hash("sha512", $orderId.$statusCode.$grossAmount.$serverKey);
        return $notification->signature_key == $hash;
    }

    private function setupTransaction(User $user, array $cart, Carbon $carbon)
    {
        \Cart::session($user->id);


        $transaction = Transaction::make();

        if(isset($user)){
            $transaction->user_id = $user->id;
        }
        $transaction->generateTransactionCode();
        $transaction->status = Transaction::STATUS_RECEIVED;
        $transaction->payment_status = Transaction::PAYMENT_STATUS_UNPAID;
        $transaction->grand_total = \Cart::getTotal();

        $transaction->save();

        return $transaction;
    }

    private function setupDetailTransaction($transaction, $cart){
        $items = [];

        foreach ($cart as $product){
            $item = [
                'id'=> $product['id'],
                'price'=>$product['price'],
                'quantity'=>$product['quantity'],
                'name'=>$product['name']
            ];
            $items[] = $item;

           TransactionDetail::create([
                'product_id'=>$item['id'],
                'transaction_id'=>$transaction->id,
                'qty'=>$item['quantity'],
                'base_price'=>$item['price'],
                'sub_total' => $item['price'] * $item['quantity']
            ]);
        }


        return $items;
    }

    private function setupSnapPayload(Transaction $transaction, User $user, $items){

        $transactionDetail = [
            'order_id' =>  $transaction->code,
            'gross_amount' =>$transaction->grand_total
        ];
        $billingAddress = [
            'first_name' => $user->profile->nama_depan,
            'last_name' => $user->profile->nama_belakang,
            'address' => $user->profile->alamat1,
            'city' => $user->profile->kota,
            'country_code' => 'IDN'
        ];
        $customerDetail = [
            'first_name' => $user->profile->nama_depan,
            'last_name' => $user->profile->nama_belakang,
            'email' => $user->email,
            'phone' => $user->phone,
            'billing_address' => $billingAddress,
            'shipping_address' => $billingAddress
        ];

        $snapPayload = [
            'enable_payments'=>Payment::PAYMENT_CHANNELS,
            'transaction_details' => $transactionDetail,
            'customer_details' => $customerDetail,
            'item_details' => $items,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => 'DAY',
                'duration' => 1,
            ],
        ];

        return $snapPayload;
    }
}
