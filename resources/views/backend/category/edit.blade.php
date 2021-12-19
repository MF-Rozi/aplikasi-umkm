@extends('backend.layouts.main')

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <div class="card-body">
                        <h5 class="card-title">
                            Edit Category
                        </h5>
                        <form action="{{ route('admin.category.update') }}" method="POST" class="">
                            @csrf
                            @method("PUT")
                            <input type="hidden" name="id" id="id" value="{{ $categoryDetail->id }}">


                            <div class="form-group">
                                <label for="name" class="form-control-label">Category Name</label>
                                <input
                                    class="form-control @error('name')
                            is-invalid
                        @enderror"
                                    type="text" id="name" name="name" value="{{ $categoryDetail->name }}">
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug" class="form-control-label">Category Slug</label>
                                <input
                                    class="form-control @error('slug')
                            is-invalid
                        @enderror"
                                    type="text" id="slug" name="slug" value="{{ $categoryDetail->slug }}" readonly>
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent" class="form-control-label">Category Parent</label>
                                <select
                                    class="form-control @error('parent')
                            is-invalid
                        @enderror"
                                    id="parent" name="parent">
                                    <option value="" {{ $categoryDetail->parent == null ? 'selected' : '' }}>Null (Doesn't
                                        Have Parent)</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $categoryDetail->parent->id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}</option>
                                    @endforeach

                                </select>
                                @error('parent')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-info">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
