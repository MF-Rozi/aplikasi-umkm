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
                            <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                <i class="fas fa-info"></i>
                                <span class="ms-1">Detail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="{{ route('admin.user.edit',['slug'=> $userDetail->profile->slug]) }}" role="tab" aria-selected="false">
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
                    <div class="table-responsive">
                        <table class="table yajra-datatable align-item-center mb-0">

                            <tr>
                                <td>ID</td>
                                <td>{{ $userDetail->id }}</td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td>{{ $userDetail->profile->slug }}</td>
                            </tr>
                            <tr>
                                <td>Address1</td>
                                <td>{{ $userDetail->profile->address1 }}</td>
                            </tr>
                            <tr>
                                <td>Address2</td>
                                <td>{{ $userDetail->profile->address2 }}</td>
                            </tr>
                            <tr>
                                <td>District</td>
                                <td>{{ $userDetail->profile->district }}</td>
                            </tr>
                            <tr>
                                <td>Province</td>
                                <td>{{ $userDetail->profile->province }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{ $userDetail->profile->state }}</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>{{ $userDetail->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $userDetail->phone }}</td>
                            </tr>
                            <tr>
                                <td>Remember Token</td>
                                <td>{{ $userDetail->remember_token }}</td>
                            </tr>
                            <tr>
                                <td>Telegram ID</td>
                                <td>{{ $userDetail->telegram_id }}</td>
                            </tr>
                            <tr>
                                <td>status</td>
                                <td>@switch($userDetail->status)
                                    @case(0)
                                    Inactive
                                    @break
                                    @case(1)
                                    Active
                                    @break
                                    @case(2)
                                    Banned
                                    @break
                                    @default
                                    Inactive
                                    @endswitch</td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
