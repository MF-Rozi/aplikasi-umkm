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
                    <h5>{{ $categoryDetail->name }}</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-item-center mb-0">
                            <tr>
                                <td>ID</td>
                                <td>{{ $categoryDetail->id }}</td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td>{{ $categoryDetail->slug }}</td>
                            </tr>
                            <tr>
                                <td>Parent</td>
                                <td>{{ $categoryDetail->parent }}</td>
                            </tr>


                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
