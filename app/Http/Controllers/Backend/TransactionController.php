<?php

namespace App\Http\Controllers\Backend;

use auth;
use Redirect;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionHistory;
use App\Http\Controllers\Controller;

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

    public function setConfirmed($id)
    {
        $transaction = Transaction::find($id);

        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'status' => Transaction::STATUS_CONFIRMED
        ]);
        $transaction->update(
            ['status' => Transaction::STATUS_CONFIRMED]
        );
        return redirect()->route('admin.transaction.index');
    }

    public function setOnProccess($id)
    {
        $transaction = Transaction::find($id);

        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'status' => Transaction::STATUS_ON_PROCESS
        ]);
        // $transaction->status = Transaction::STATUS_ON_PROCESS;
        $transaction->update(
            ['status' => Transaction::STATUS_ON_PROCESS]
        );
        return redirect()->route('admin.transaction.index');
    }

    public function setDelivery($id)
    {
        $transaction = Transaction::find($id);

        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'status' => Transaction::STATUS_DELIVERY
        ]);
        // $transaction->status = Transaction::STATUS_ON_PROCESS;
        $transaction->update(
            ['status' => Transaction::STATUS_DELIVERY]
        );
        return redirect()->route('admin.transaction.index');
    }

    public function setDone($id)
    {
        $transaction = Transaction::find($id);

        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'status' => Transaction::STATUS_DONE
        ]);
        // $transaction->status = Transaction::STATUS_ON_PROCESS;
        $transaction->update(
            ['status' => Transaction::STATUS_DONE]
        );
        return redirect()->route('admin.transaction.index');
    }

    public function setCancel($id)
    {
        $transaction = Transaction::find($id);

        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'status' => Transaction::STATUS_CANCELLED
        ]);
        // $transaction->status = Transaction::STATUS_ON_PROCESS;
        $transaction->update(
            ['status' => Transaction::STATUS_CANCELLED]
        );
        return redirect()->route('admin.transaction.index');
    }

    public function showTransaction($id)
    {
        $transaction = Transaction::find($id);

        $product = Product::find($transaction->details()->first()->product_id);
        // dd($transaction);

        return view('backend.transaction.show', [
            'title' => 'Transactions Detail',
            'transaction' => $transaction,
            'product' => $product
        ]);
    }
}
