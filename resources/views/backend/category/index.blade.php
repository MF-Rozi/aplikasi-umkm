@extends('backend.layouts.main')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex d-flex justify-content-between">
                    <div class="card-header pb-0">
                        <h6>Categories</h6>
                    </div>
                    <div class="card-header pb-0">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-success">Create Category</a>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table yajra-datatable align-item-center mb-0">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
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
            , ajax: "{{ route('admin.category.index.datatable') }}"
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'slug'
                    , name: 'slug'
                }
                , {
                    data: 'parent'
                    , name: 'parent'
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
