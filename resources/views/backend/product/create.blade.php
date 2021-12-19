@extends('backend.layouts.main')

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-12">
                <div class="card px-3 py-3">
                    <h5>Create Product</h5>
                    <hr>
                    @include('backend.product._form',['method'=>'post', 'action'=>route('admin.product.store'),'new'=>true])

                </div>
            </div>
        </div>
    </div>
@endsection

