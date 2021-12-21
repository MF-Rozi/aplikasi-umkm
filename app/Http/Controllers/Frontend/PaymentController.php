<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaction;
use App\Services\Midtrans\Facades\Midtrans;
use App\Services\Midtrans\Notification;
use Illuminate\Http\Request;

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

            $transaction = Transaction::where('code', $orderId)->firstOrDie();

            $payment = Payment::make([]);

            if ($notifTransactionStatus == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                    }
                }
            } elseif ($notifTransactionStatus == 'settlement') {
                // TODO set payment status in merchant's database to 'Settlement'
            } elseif ($notifTransactionStatus == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
            } elseif ($notifTransactionStatus == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
            } elseif ($notifTransactionStatus == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
            } elseif ($notifTransactionStatus == 'cancel') {
                // TODO set payment status in merchant's database to 'Denied'
            }
        }
    }

    public function create(Request $request)
    {
    }

    public function success(Request $request)
    {
    }

    public function failed(Request $request)
    {
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
}
