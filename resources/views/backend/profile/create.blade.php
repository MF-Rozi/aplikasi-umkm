@extends('backend.layouts.main')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-12">
            <div class="card px-3 py-3">
                @if (session('create'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('create') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <h5>Create Profile for {{ $user->email }}</h5>
                <hr>
                <form method="post" action="{{ route('admin.profile.store') }}">
                    @method('put')
                    @csrf
                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                    <div class="form-group">
                        <label for="first_name" class="form-control-label">First Name <span style="color: red">*</span> </label>
                        <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" placeholder="Enter Your First Name">
                        @error('first_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-control-label">Last Name <span style="color: red">*</span> </label>
                        <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" placeholder="Enter Your Last Name">
                        @error('last_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address1" class="form-control-label">Address 1 <span style="color: red">*</span> </label>
                        <input class="form-control @error('address1') is-invalid @enderror" type="text" name="address1" id="address1" placeholder="Enter Your First Adress">
                        @error('address1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address2" class="form-control-label">Address 2 <span style="color: red">*</span> </label>
                        <input class="form-control @error('address2') is-invalid @enderror" type="text" name="address2" id="address2" placeholder="Enter Your Second Adress">
                        @error('address2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="district" class="form-control-label">District <span style="color: red">*</span> </label>
                        <input class="form-control @error('district') is-invalid @enderror" type="text" name="district" id="district" placeholder="Enter Your District Name">
                        @error('district')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="province" class="form-control-label">Province <span style="color: red">*</span> </label>
                        <input class="form-control @error('province') is-invalid @enderror" type="text" name="province" id="province" placeholder="Enter Your Province Name">
                        @error('province')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="state" class="form-control-label">State <span style="color: red">*</span> </label>
                        <input class="form-control @error('state') is-invalid @enderror" type="text" name="state" id="state" placeholder="Enter Your State Name">
                        @error('state')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="post_code" class="form-control-label">Post Code <span style="color: red">*</span> </label>
                        <input class="form-control @error('post_code') is-invalid @enderror" type="text" name="post_code" id="post_code" placeholder="Enter Your Post Code">
                        @error('post_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="hidden" value="placeholder.png" name="photo_profile">
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
