@extends('backend.layouts.main')

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-12">
                <div class="card px-3 py-3">
                    <h5>Create Product</h5>
                    <hr>
                    <form action="{{ route('admin.product.store') }}" method="POST" name="createProduct">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-control-label">Product Name <span style="color: red">*</span>
                            </label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name"
                                placeholder="Enter Product Name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-control-label">Product Price <span style="color: red">*</span>
                            </label>
                            <input class="form-control @error('price') is-invalid @enderror" type="number" name="price"
                                id="price" placeholder="Enter Product Price" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock" class="form-control-label">Product Stock <span style="color: red">*</span>
                            </label>
                            <input class="form-control @error('stock') is-invalid @enderror" type="number" name="stock"
                                id="stock" placeholder="Enter Product Stock" value="{{ old('stock') }}">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="code" class="form-control-label">Product Code <span style="color: red">*</span>
                            </label>
                            <input class="form-control @error('code') is-invalid @enderror" type="text" name="code"
                                id="code" placeholder="Enter Product Code" value="{{ old('code') }}">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
