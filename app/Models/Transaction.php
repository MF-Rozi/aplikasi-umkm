<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_UNPAID = 'unpaid';

    const STATUS_RECEIVED = 'received';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_ON_PROCESS = 'on-process';
    const STATUS_DELIVERY = 'delivery';
    const STATUS_DONE = 'done';
    const STATUS_CANCELLED = 'cancelled';

    const TRANSACTION_CODE_FORMAT = 'TRX/UMKM/{date}/';

    protected $guarded = ['id'];

    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    public function histories()
    {
        return $this->hasMany(TransactionHistory::class);
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($transaction) {

            $transaction->generateTransactionCode();
        });
    }

    public function generateTransactionCode()
    {
        $now = Carbon::now();
        $code = strtr(self::TRANSACTION_CODE_FORMAT, [
            '{date}' => $now->isoFormat('YYYYMMDD'),
        ]);
        $lastOrder = static::where('code', 'like', '%'.$code.'%')->orderBy('id', 'desc')->first();
        $lastOrderCode = $lastOrder->code ?? null;
        // dd($lastOrderCode);
        $transactionCode = $code.'000001';
        if ($lastOrderCode) {
            $lastOrderNumber = str_replace($code, '', $lastOrderCode);
            $nextOrderNumber = sprintf('%05d', (int) $lastOrderNumber + 1);
            $transactionCode = $code . $nextOrderNumber;
        }
        if ($this->isOrderCodeExist($transactionCode)) {
            throw new Exception('transaction code exists');
        }

        $this->attributes['code'] = $transactionCode;

        if (is_null($this->attributes['code'])) {
            return false; // failed to create code
        } else {
            return true;
        }
    }

    private function isOrderCodeExist($orderCode)
    {
        return self::where('code', $orderCode)->exists();
    }
}
