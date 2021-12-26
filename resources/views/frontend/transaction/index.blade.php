@extends('frontend.layouts.main')

@section('content')
<!-- breadcrumb-section -->
<div class="breadcrumb-section about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center ">
                <div class="breadcrumb-text">
                    <p>{{ Auth::user()->profile->full_name }}</p>
                    <h1>Transaction</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

{{-- Transaction Section --}}
<div class="product-section mt-150 mb-150">
    <div class="container">
        <table id="datatable" class="table yajra-datatable align-item-center mb-0 text-center">
            <thead>
                <tr>

                    <th>User</th>
                    <th>Code</th>
                    <th>Grand Total</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach (Auth::user()->transactions as $transaction)

                <tr>

                    <th>{{ $transaction->user->profile->full_name }}</th>
                    <th>{{ $transaction->code }}</th>
                    <th>{{ rupiah($transaction->grand_total).'.000' }}</th>
                    <th>{{ $transaction->status }}</th>
                    <th>{{ $transaction->payment_status }}</th>
                    <th>
                        <a href="{{ route('frontend.transaction.show',['id'=>$transaction->id]) }}" class="boxed-btn">Detail </a>
                    </th>

                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
</div>

{{-- end Transaction Section --}}

@endsection
