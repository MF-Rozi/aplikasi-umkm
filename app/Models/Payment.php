<?php

namespace App\Models;

use App\Events\PaymentConfirmed;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_SETTLEMENT = 'settlement';
    const STATUS_EXPIRE = 'expire';
    const STATUS_CAPTURE = 'capture';
    const STATUS_AUTHORIZE = 'authorize';
    const STATUS_DENY = 'deny';
    const STATUS_CANCEL = 'cancel';
    const STATUS_REFUND = 'refund';
    const STATUS_PARTIAL_REFUND = 'partial_refund';
    const STATUS_CHARGEBACK = 'chargeback';
    const STATUS_PARTIAL_CHARGEBACK = 'partial_chargeback';
    const STATUS_FAILURE = 'failure';
    const STATUS_CHALLENGED = 'challenged';

    const PAYMENT_CODE_FORMAT = 'PAY/UMKM/{date}/';
    const PAYMENT_CHANNELS = ['credit_card','mandiri_clickpay','cimb_clicks','bca_klikbca','bca_klikpay','bri_epay','echannel','permata_va','bca_va','bni_va','other_va','gopay','indomaret',
        'danamon_online','akulaku','kioson','echannel',
    ];

    protected $guarded = ['id', 'code'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_code', 'code');
    }

    protected $dispatchesEvents = [
        'created' => PaymentConfirmed::class,
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($payment) {

            $payment->generatePaymentCode();
        });
    }

    /**
     * Check if the generated order code is exists
     *
     * @param string $orderCode order code
     *
     * @return boolean
     */
    private function isOrderCodeExist($orderCode)
    {
        return self::where(['code', $orderCode])->exists();
    }

    private function generatePaymentCode()
    {
        $now = Carbon::now();
        $code = strtr(self::PAYMENT_CODE_FORMAT, [
            '{date}' => $now->isoFormat('YYYYMMDD'),
        ]);
        $lastOrder = static::where(['code', 'like', $code])->orderBy('id', 'desc')->first();
        $lastOrderCode = $lastOrder->code ?? null;
        $paymentCode = $code.'000001';
        if ($lastOrderCode) {
            $lastOrderNumber = str_replace($code, '', $lastOrderCode);
            $nextOrderNumber = sprintf('%05d', (int) $lastOrderNumber + 1);
            $paymentCode = $code . $nextOrderNumber;
        }
        if ($this->isOrderCodeExist($paymentCode)) {
            throw new Exception('kode pembayaran exists');
        }

        $this->attributes['code'] = $paymentCode;

        if (is_null($this->attributes['code'])) {
            return false; // failed to create code
        } else {
            return true;
        }
    }
}
