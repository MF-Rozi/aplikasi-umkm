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
                <h5>Create User</h5>
                <hr>
                <form method="POST" name="userCreate" action="{{ route('admin.user.store') }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email <span style="color: red">*</span> </label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" placeholder="Enter Your Email Adress" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Password <span style="color: red">*</span> </label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Enter Your password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-control-label">Password Confirmation <span style="color: red">*</span> </label>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter Password Confirmation">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-control-label">Phone <span style="color: red">*</span> </label>
                        <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" placeholder="Enter Your Phone Number" value="{{ old('phone') }}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telegram_id" class="form-control-label">Telegram ID </label>
                        <input class="form-control @error('telegram_id') is-invalid @enderror" type="text" name="telegram_id" id="telegram_id" placeholder="Enter Your telegram_id Number" value="{{ old('telegram_id') }}">
                        @error('telegram_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role" class="form-control-label">Role</label>
                        <select class="form-control @error('role')
                            is-invalid
                        @enderror" id="role" name="role">
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
                            <option value="super-admin">Super Admin</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="hidden" value="{{ Str::random(6) }}" name="remember_token">
                    <button class="btn btn-info" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
