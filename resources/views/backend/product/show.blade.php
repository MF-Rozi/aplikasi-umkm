@extends('backend.layouts.main')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-12">
            <div class="card px-3 py-3">
                <div class="card-body pb-2">
                    <h5>{{ $productDetail->name }}</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-item-center mb-0">
                            <tr>
                                <td>ID</td>
                                <td>{{ $productDetail->id }}</td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td>{{ $productDetail->slug }}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>Rp. {{ number_format($productDetail->price,2,',','.') }}</td>
                            </tr>


                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
