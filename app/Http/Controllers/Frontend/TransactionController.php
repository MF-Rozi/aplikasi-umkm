<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $transaction = $user->transactions;

        return view('frontend.transaction.index', [
            'user' => $user,
            'transaction' => $transaction,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        $histories = $transaction->histories();
        $product = Product::find($transaction->details()->first()->product_id);
        // dd($histories->first());

        // return view('frontend.transaction.show', [
        //     'transaction' => $transaction,
        //     'histories' => $histories,
        //     'product' => $product,
        // ]);

        return view('frontend.transaction.show', compact(['transaction', 'histories', 'product']));
    }

    public function cancel(Request $request)
    {
        // dd($request);
        $note = $request->note;
        $transaction = Transaction::find($request->id);
        $transaction->update(
            [
            'status' => Transaction::STATUS_CANCELLED,
            'cancelation_note' => $note,
            'cancelled_at' => Carbon::now(),
            ]
        );
        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'status' => Transaction::STATUS_CANCELLED
        ]);



        alert()->success('Cancelation success', 'Your transaction has been cancelled successfully.');

        return redirect()->route('frontend.transaction.index');
    }
}
