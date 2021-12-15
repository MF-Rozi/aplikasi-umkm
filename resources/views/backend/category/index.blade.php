@extends('backend.layouts.main')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Categories</h6>
                    </div>
                    <div class="card-header pb-0">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-success">Create Category</a>
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
                                    <th>Parent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1?>
                                @foreach ($categories as $category)
                                <tr>
                                    <th>{{ $no }}</th>
                                    <th>{{ $category->id }}</th>
                                    <th>{{ $category->name }}</th>
                                    <th>{{ $category->slug }}</th>
                                    <th>{{ $category->parent }}</th>
                                    <th>
                                        <a href="{{ route('admin.category.show', ['slug' => $category->slug]) }}" class="detail btn btn-info btn-sm">detail</a> <a href="{{ route('admin.category.edit', ['slug' => $category->slug]) }}" class="edit btn btn-warning btn-sm">Edit</a> <a href="{{ route('admin.category.delete', ['slug' => $category->slug]) }}" class="delete btn btn-danger btn-sm">Delete</a>
                                    </th>
                                </tr>

                                <?php $no += 1?>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $categories->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
