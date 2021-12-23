<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $transaction = Transaction::where($id)->firstOrDie();
        $histories = $transaction->histories();

        return view('frontend.transaction.show', [
            'transaction' => $transaction,
            'histories' => $histories
        ]);
    }

    public function cancel(Request $request)
    {

        $note = $request->note;
        $transaction = Transaction::where($request->id);
        $transaction->note = $note;
        $transaction->cancelled_at = Carbon::now();
        $transaction->save();

        alert()->success('Cancelation success', 'Your transaction has been cancelled successfully.');

        return redirect('frontend.transaction.index');
    }
}
