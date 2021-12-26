@extends('frontend.layouts.main')

@section('content')
<!-- breadcrumb-section -->
<div class="breadcrumb-section about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>{{ Auth::user()->email }}</p>
                    <h1>Profile</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->
<!-- cart section -->
<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="card-body pb-2">
                <hr>
                <h5>User Profile</h5>
                <form method="POST" name="profileUpdate" action="{{ route('frontend.home.profileUpdate') }}">

                    @csrf
                    <input type="hidden" value="{{ $user->profile->slug }}" name="slug">
                    <div class="form-group">
                        <label for="firstName" class="form-control-label">First Name</label>
                        <input class="form-control @error('firstName') is-invalid @enderror" type="text" name="firstName" id="firstName" value="{{ $user->profile->first_name }} ">
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
                        @enderror" type="text" id="lastName" name="lastName" value="{{ $user->profile->last_name }}">
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
                        @enderror" type="text" id="address1" name="address1" value="{{ $user->profile->address1 }}">
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
                        @enderror" type="text" id="address2" name="address2" value="{{ $user->profile->address2 }}">
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
                        @enderror" type="text" id="district" name="district" value="{{ $user->profile->district }}">
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
                        @enderror" type="text" id="province" name="province" value="{{ $user->profile->province }}">
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
                        @enderror" type="text" id="state" name="state" value="{{ $user->profile->state }}">
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
                        @enderror" type="text" id="postCode" name="postCode" value="{{ $user->profile->post_code }}">
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
                            <option value="0" {{ ($user->status == 0) ? 'selected': ''}}>Inactive</option>
                            <option value="1" {{ ($user->status == 1) ? 'selected': ''}}>Active</option>
                            <option value="2" {{ ($user->status == 2) ? 'selected': ''}}>Banned</option>
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
                        @enderror" type="text" id="telegramID" name="telegramID" value="{{ $user->telegram_id }}">
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
                        @enderror" type="email" id="email" name="email" value="{{ $user->email }}" readonly>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button class="boxed-btn" type="submit"> Update</button>
                </form>
            </div>
            <div class="card-body pb-2">
                <hr>
                <h5>Change Password</h5>

                <form method="POST" name="passwordUpdate" action="{{ route('frontend.home.passwordUpdate') }}">

                    @csrf
                    <input type="hidden" value="{{ $user->profile->slug }}" name="slug">
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

                    <button class="boxed-btn" type="submit"> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end cart -->
@endsection
