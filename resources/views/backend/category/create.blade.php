@extends("backend.layouts.main")

@section("content")
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-12">
            <div class="card px-3 py-3">
                <h5>Create Category</h5>
                <hr>
                <form action="{{ route('admin.category.store') }}" method="POST" name="createCategory">
                    @csrf
                    @method("put")
                    <div class="form-group">
                        <label for="name" class="form-control-label">Category Name <span style="color: red">*</span> </label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Enter Category Name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent" class="form-control-label">Category Parent</label>
                        <select class="form-control @error('parent')
                            is-invalid
                        @enderror" id="parent" name="parent">
                            <option value="">No Category Parent</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach

                        </select>
                        @error('parent')
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
