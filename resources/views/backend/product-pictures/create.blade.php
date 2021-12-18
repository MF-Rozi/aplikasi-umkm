@extends('backend.layouts.main')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-12">
            <div class="card px-3 py-3">
                <form method="post" action="{{ route('admin.product.picture.store') }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                    <h5>Product: {{ $product->name }}</h5>
                    <label for="formFile" class="form-label">Product Picture</label>
                    <input class="form-control @error('product_picture') is-invalid @enderror" type="file" accept="image/png, image/gif, image/jpeg" id="formFile" name="product_picture">
                    @error('product_picture')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
