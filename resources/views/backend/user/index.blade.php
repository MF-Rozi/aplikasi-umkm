@extends('backend.layouts.main')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Users</h6>
                    </div>
                    <div class="card-header pb-0">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-success">Create User</a>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table yajra-datatable align-item-center mb-0" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script-body')
<script type="text/javascript">
    $(function() {

        var table = $('.yajra-datatable').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.user.index.datatable') }}",
            language: {
                paginate: {
                    next : "&gt;",
                    previous : "&lt;"
                }
            }

            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                }
                , {
                    data: 'email'
                    , name: 'email'
                }
                , {
                    data: 'phone'
                    , name: 'phone'
                }
                , {
                    data: 'status'
                    , name: 'status'
                }

                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: true
                    , searchable: true
                }
            , ]
        });

    });

</script>

@endsection
