@extends('backend.layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                @if (session('edit'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('edit') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card-body pb-2">
                    <h5 class="card-title">{{ $transaction->transaction_id }}</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-item-center mb-0">
                            <tr></tr>
                            <td>Product</td>
                            <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td>{{ $transaction->code }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $transaction->status }}</td>
                            </tr>
                            <tr>
                                <td>Payment URL</td>
                                <td>{{ $transaction->payment_url }}</td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>{{ $transaction->payment_status }}</td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td>{{ $transaction->details()->first()->qty }}</td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td>{{ rupiah($transaction->grand_total).'.000' }}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
