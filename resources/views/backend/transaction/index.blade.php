@extends('backend.layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Transaction Received</h6>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">Create Product</a>
                </div> --}}
            </div>
            <div class="card-body mb-2">
                <div class="table-responsive">
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

                            @foreach ($transactions as $transaction)
                            @if($transaction->histories->last()->status=='received')
                            <tr>

                                <th>{{ $transaction->user->profile->full_name }}</th>
                                <th>{{ $transaction->code }}</th>
                                <th>{{ rupiah($transaction->grand_total).'.000' }}</th>
                                <th>{{ $transaction->status }}</th>
                                <th>{{ $transaction->payment_status }}</th>
                                <th>
                                    <a href="{{ route('admin.transaction.confirmed',['id'=>$transaction->id]) }}"> <button class="btn btn-info">Confirmed</button> </a>
                                    <a href="{{ route('admin.transaction.canceled',['id'=>$transaction->id]) }}"> <button class="btn btn-danger">Cancel</button> </a>
                                    <a href="{{ route('admin.transaction.show',['id'=>$transaction->id]) }}"> <button class="btn btn-primary">Detail</button> </a>
                                </th>

                            </tr>
                            @else

                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Transaction Confirmed</h6>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">Create Product</a>
                </div> --}}
            </div>
            <div class="card-body mb-2">
                <div class="table-responsive">
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

                            @foreach ($transactions as $transaction)
                            @if($transaction->histories->last()->status=='confirmed')
                            <tr>

                                <th>{{ $transaction->user->profile->full_name }}</th>
                                <th>{{ $transaction->code }}</th>
                                <th>{{ rupiah($transaction->grand_total).'.000' }}</th>
                                <th>{{ $transaction->status }}</th>
                                <th>{{ $transaction->payment_status }}</th>
                                <th>
                                    <a href="{{ route('admin.transaction.process',['id'=>$transaction->id]) }}"> <button class="btn btn-info">On-Process</button> </a>
                                    <a href="{{ route('admin.transaction.canceled',['id'=>$transaction->id]) }}"> <button class="btn btn-danger">Cancel</button> </a>
                                    <a href="{{ route('admin.transaction.show',['id'=>$transaction->id]) }}"> <button class="btn btn-primary">Detail</button> </a>
                                </th>

                            </tr>
                            @else

                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Transaction On-Process</h6>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">Create Product</a>
                </div> --}}
            </div>
            <div class="card-body mb-2">
                <div class="table-responsive">
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

                            @foreach ($transactions as $transaction)
                            @if($transaction->histories->last()->status=='on-process')
                            <tr>

                                <th>{{ $transaction->user->profile->full_name }}</th>
                                <th>{{ $transaction->code }}</th>
                                <th>{{ rupiah($transaction->grand_total).'.000' }}</th>
                                <th>{{ $transaction->status }}</th>
                                <th>{{ $transaction->payment_status }}</th>
                                <th>
                                    <a href="{{ route('admin.transaction.delivery',['id'=>$transaction->id]) }}"> <button class="btn btn-info">Delivery</button> </a>
                                    <a href="{{ route('admin.transaction.canceled',['id'=>$transaction->id]) }}"> <button class="btn btn-danger">Cancel</button> </a>
                                    <a href="{{ route('admin.transaction.show',['id'=>$transaction->id]) }}"> <button class="btn btn-primary">Detail</button> </a>
                                </th>

                            </tr>
                            @else

                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Transaction Delivery</h6>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">Create Product</a>
                </div> --}}
            </div>
            <div class="card-body mb-2">
                <div class="table-responsive">
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

                            @foreach ($transactions as $transaction)
                            @if($transaction->histories->last()->status=='delivery')
                            <tr>

                                <th>{{ $transaction->user->profile->full_name }}</th>
                                <th>{{ $transaction->code }}</th>
                                <th>{{ rupiah($transaction->grand_total).'.000' }}</th>
                                <th>{{ $transaction->status }}</th>
                                <th>{{ $transaction->payment_status }}</th>
                                <th>
                                    <a href="{{ route('admin.transaction.done',['id'=>$transaction->id]) }}"> <button class="btn btn-info">Done</button> </a>
                                    <a href="{{ route('admin.transaction.canceled',['id'=>$transaction->id]) }}"> <button class="btn btn-danger">Cancel</button> </a>
                                    <a href="{{ route('admin.transaction.show',['id'=>$transaction->id]) }}"> <button class="btn btn-primary">Detail</button> </a>
                                </th>

                            </tr>
                            @else

                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Transaction Done</h6>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">Create Product</a>
                </div> --}}
            </div>
            <div class="card-body mb-2">
                <div class="table-responsive">
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

                            @foreach ($transactions as $transaction)
                            @if($transaction->histories->last()->status=='done')
                            <tr>

                                <th>{{ $transaction->user->profile->full_name }}</th>
                                <th>{{ $transaction->code }}</th>
                                <th>{{ rupiah($transaction->grand_total).'.000' }}</th>
                                <th>{{ $transaction->status }}</th>
                                <th>{{ $transaction->payment_status }}</th>
                                <th><a href="{{ route('admin.transaction.show',['id'=>$transaction->id]) }}"> <button class="btn btn-primary">Detail</button> </a></th>

                            </tr>
                            @else

                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Transaction Cancelled</h6>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">Create Product</a>
                </div> --}}
            </div>
            <div class="card-body mb-2">
                <div class="table-responsive">
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

                            @foreach ($transactions as $transaction)
                            @if($transaction->histories->last()->status=='cancelled')
                            <tr>

                                <th>{{ $transaction->user->profile->full_name }}</th>
                                <th>{{ $transaction->code }}</th>
                                <th>{{ rupiah($transaction->grand_total).'.000' }}</th>
                                <th>{{ $transaction->status }}</th>
                                <th>{{ $transaction->payment_status }}</th>
                                <th><a href="{{ route('admin.transaction.show',['id'=>$transaction->id]) }}"> <button class="btn btn-primary">Detail</button> </a></th>

                            </tr>
                            @else

                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
