@extends('backend.layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Producs</h6>
                    </div>
                    <div class="card-header pb-0">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">Create Product</a>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table yajra-datatable align-item-center mb-0">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Stock</th>
                                    <th>Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1?>
                                @foreach ($products as $product)
                                <tr>
                                    <th>{{ $no }}</th>
                                    <th>{{ $product->id }}</th>
                                    <th>{{ $product->name }}</th>
                                    <th>{{ $product->slug }}</th>
                                    <th>{{ $product->stock }}</th>
                                    <th>{{ $product->code }}</th>
                                    <th>
                                        <a href="{{ route('admin.product.show', ['slug' => $product->slug]) }}" class="detail btn btn-info btn-sm">detail</a> <a href="{{ route('admin.product.edit', ['slug' => $product->slug]) }}" class="edit btn btn-warning btn-sm">Edit</a> <a href="{{ route('admin.product.delete', ['slug' => $product->slug]) }}" class="delete btn btn-danger btn-sm">Delete</a>
                                    </th>
                                </tr>

                                <?php $no += 1?>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $products->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
