@extends('layouts.admin_app') 
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@stop
@section('title', 'Banners') 
@section('breadcrumbs', Breadcrumbs::render('banner.index')) 
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="mb-2">
                    <a href="{{ route('banner.create')}}" role="button" class="btn bg-gradient-info btn-lg">{{__('Add Banner')}}</a>
                </div>
                <table id="banner-list-table" class="table table-bordered table-hover projects">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#banner-list-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url : "{{route('banner.index')}}"
                },
                "columns":[
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'active',
                        name: 'active',
                        render: function(data, type, full, meta) {
                            if(data == '1') {
                                return '<span class="badge badge-success">Active</span>';
                            }
                            return '<span class="badge badge-danger">Inactive</span>';
                        }
                    },
                    {
                        data: 'order',
                        name: 'order'

                    },
                    {
                        data: 'created_by.name',
                        name: 'created_by.name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'file',
                        name: 'Image',
                        render: function(data, type, full, meta) {
                            return "<img src={{asset('storage')}}" + data + " class='product-image-thumb'/>"
                        },
                        orderable : false 
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                oLanguage: {
                      "sEmptyTable": "No records found"
                }
            })
        });
    </script>
    <script src="{{ asset('js/banner.js') }}"></script>
@stop