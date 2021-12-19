@extends('backend.layouts.main')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.product.index') }}
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="d-flex d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h6>Products</h6>
                        </div>
                        <div class="card-header pb-0">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-success">Create Product</a>
                        </div>
                    </div>
                    <div class="card-body mb-2">
                        <div class="table-responsive">
                            <table id="datatable" class="table yajra-datatable align-item-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Code</th>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.product.index.datatable') }}",
                language: {
                    //url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json',
                    paginate: {
                        next: "&gt;",
                        previous: "&lt;"
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        type: 'num-fmt'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
