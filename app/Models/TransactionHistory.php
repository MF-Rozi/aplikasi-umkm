<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistory extends Model
{
    use HasFactory, SoftDeletes;

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
