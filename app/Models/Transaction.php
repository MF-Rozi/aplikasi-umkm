<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
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
}
