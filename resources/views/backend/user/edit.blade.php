@extends('backend.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{ asset("backend/assets/img/curved-images/curved0.jpg") }}'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset("storage/users/image/{$userDetail->profile->photo_profile}"); }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $userDetail->profile->full_name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ $userDetail->getRoleNames()->implode('') }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1  " href="{{ route('admin.user.show',['slug'=> $userDetail->profile->slug]) }}" role="button">
                                <i class="fas fa-info"></i>
                                <span class="ms-1">Detail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1  " href="{{ route('admin.user.edit',['slug'=> $userDetail->profile->slug]) }}" role="button">
                                <i class="fas fa-edit"></i>
                                <span class="ms-1">Edit</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " href="{{ route('admin.user.delete',['slug'=> $userDetail->profile->slug]) }}" role="button">
                                <i class="fas fa-trash-alt"></i>
                                <span class="ms-1">Delete</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                @if (session('updatePassword'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('updatePassword') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card-body pb-2">
                    <form method="POST" name="profileUpdate" action="{{ route('admin.user.update') }}">
                        @method('put')
                        @csrf
                        <input type="hidden" value="{{ $userDetail->profile->slug }}" name="slug">
                        <div class="form-group">
                            <label for="firstName" class="form-control-label">First Name</label>
                            <input class="form-control @error('firstName') is-invalid @enderror" type="text" name="firstName" id="firstName" value="{{ $userDetail->profile->first_name }} ">
                            @error('firstName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="form-control-label">Last Name</label>
                            <input class="form-control @error('lastName')
                                is-invalid
                            @enderror" type="text" id="lastName" name="lastName" value="{{ $userDetail->profile->last_name }}">
                            @error('lastName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address1" class="form-control-label">Adress 1</label>
                            <input class="form-control @error('address1')
                                is-invalid
                            @enderror" type="text" id="address1" name="address1" value="{{ $userDetail->profile->address1 }}">
                            @error('address1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address2" class="form-control-label">Adress 2</label>
                            <input class="form-control @error('adress2')
                                is-invalid
                            @enderror" type="text" id="address2" name="address2" value="{{ $userDetail->profile->address2 }}">
                            @error('address2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="district" class="form-control-label">District</label>
                            <input class="form-control @error('district')
                                is-invalid
                            @enderror" type="text" id="district" name="district" value="{{ $userDetail->profile->district }}">
                            @error('district')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="province" class="form-control-label">Province</label>
                            <input class="form-control @error('province')
                                is-invalid
                            @enderror" type="text" id="province" name="province" value="{{ $userDetail->profile->province }}">
                            @error('province')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="state" class="form-control-label">State</label>
                            <input class="form-control @error('state')
                                is-invalid
                            @enderror" type="text" id="state" name="state" value="{{ $userDetail->profile->state }}">
                            @error('state')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postCode" class="form-control-label">Post Code</label>
                            <input class="form-control @error('postCode')
                                is-invalid
                            @enderror" type="text" id="postCode" name="postCode" value="{{ $userDetail->profile->post_code }}">
                            @error('postCode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <select class="form-control @error('status')
                                is-invalid
                            @enderror" id="status" name="status">
                                <option value="0" {{ ($userDetail->status == 0) ? 'selected': ''}}>Inactive</option>
                                <option value="1" {{ ($userDetail->status == 1) ? 'selected': ''}}>Active</option>
                                <option value="2" {{ ($userDetail->status == 2) ? 'selected': ''}}>Banned</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telegramID" class="form-control-label">Telegram ID</label>
                            <input class="form-control @error('telegramID')
                                is-invalid
                            @enderror" type="text" id="telegramID" name="telegramID" value="{{ $userDetail->telegram_id }}">
                            @error('telegramID')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control @error('email')
                                is-invalid
                            @enderror" type="email" id="email" name="email" value="{{ $userDetail->email }}" readonly>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary" type="submit"> Update</button>
                    </form>
                </div>
                <div class="card-body pb-2">
                    <hr>
                    <h5>Change Password</h5>

                    <form method="POST" name="passwordUpdate" action="{{ route('admin.user.update.password') }}">
                        @method('put')
                        @csrf
                        <input type="hidden" value="{{ $userDetail->profile->slug }}" name="slug">
                        <div class="form-group">
                            <label for="password" class="form-control-label">New Password</label>
                            <input class="form-control @error('password')
                                is-invalid
                            @enderror" type="password" name="password" id="password" placeholder="Enter new Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-control-label">Confirm Password</label>
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password">
                        </div>

                        <button class="btn btn-primary" type="submit"> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
