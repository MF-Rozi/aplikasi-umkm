<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_SUCCESS = 'success';
    const PAYMENT_STATUS_SETTLEMENT = 'settlement';
    const PAYMENT_STATUS_EXPIRE = 'expire';
    const PAYMENT_STATUS_CAPTURE = 'capture';
    const PAYMENT_STATUS_AUTHORIZE = 'authorize';
    const PAYMENT_STATUS_DENY = 'deny';
    const PAYMENT_STATUS_CANCEL = 'cancel';
    const PAYMENT_STATUS_REFUND = 'refund';
    const PAYMENT_STATUS_PARTIAL_REFUND = 'partial_refund';
    const PAYMENT_STATUS_CHARGEBACK = 'chargeback';
    const PAYMENT_STATUS_PARTIAL_CHARGEBACK = 'partial_chargeback';
    const PAYMENT_STATUS_FAILURE = 'failure';

    protected $guarded = ['id', 'code'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_code', 'code');
    }
}
