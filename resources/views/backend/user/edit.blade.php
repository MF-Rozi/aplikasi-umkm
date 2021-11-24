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
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="fas fa-info"></i>
                                <span class="ms-1">Detail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                <i class="fas fa-edit"></i>

                                <span class="ms-1">Edit</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
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

                <div class="card-body pb-2">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="firstName" class="form-control-label">First Name</label>
                            <input class="form-control" type="text" id="firstName" value="{{ $userDetail->profile->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="form-control-label">Last Name</label>
                            <input class="form-control" type="text" id="lastName" value="{{ $userDetail->profile->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="example-search-input" class="form-control-label">Search</label>
                            <input class="form-control" type="search" value="Tell me your secret ..." id="example-search-input">
                        </div>
                        <div class="form-group">
                            <label for="example-email-input" class="form-control-label">Email</label>
                            <input class="form-control" type="email" value="@example.com" id="example-email-input">
                        </div>
                        <div class="form-group">
                            <label for="example-url-input" class="form-control-label">URL</label>
                            <input class="form-control" type="url" value="" id="example-url-input">
                        </div>
                        <div class="form-group">
                            <label for="example-tel-input" class="form-control-label">Phone</label>
                            <input class="form-control" type="tel" value="40-(770)-888-444" id="example-tel-input">
                        </div>
                        <div class="form-group">
                            <label for="example-password-input" class="form-control-label">Password</label>
                            <input class="form-control" type="password" value="password" id="example-password-input">
                        </div>
                        <div class="form-group">
                            <label for="example-number-input" class="form-control-label">Number</label>
                            <input class="form-control" type="number" value="23" id="example-number-input">
                        </div>
                        <div class="form-group">
                            <label for="example-datetime-local-input" class="form-control-label">Datetime</label>
                            <input class="form-control" type="datetime-local" value="2018-11-23T10:30:00" id="example-datetime-local-input">
                        </div>
                        <div class="form-group">
                            <label for="example-date-input" class="form-control-label">Date</label>
                            <input class="form-control" type="date" value="2018-11-23" id="example-date-input">
                        </div>
                        <div class="form-group">
                            <label for="example-month-input" class="form-control-label">Month</label>
                            <input class="form-control" type="month" value="2018-11" id="example-month-input">
                        </div>
                        <div class="form-group">
                            <label for="example-week-input" class="form-control-label">Week</label>
                            <input class="form-control" type="week" value="2018-W23" id="example-week-input">
                        </div>
                        <div class="form-group">
                            <label for="example-time-input" class="form-control-label">Time</label>
                            <input class="form-control" type="time" value="10:30:00" id="example-time-input">
                        </div>
                        <div class="form-group">
                            <label for="example-color-input" class="form-control-label">Color</label>
                            <input class="form-control" type="color" value="#5e72e4" id="example-color-input">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
