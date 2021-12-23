<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::all();

        return view('backend.transaction.index', [
            'title' => 'Transactions',
            'transactions' => $transaction,
        ]);
    }
}
