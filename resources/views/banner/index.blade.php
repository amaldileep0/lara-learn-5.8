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
                @if(session()->get('success'))
                    <div class="alert alert-success alert-dismissible mb-3">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      {{ session()->get('success') }}  
                    </div>
                @endif
            <div class="card-body table-responsive">
                <div class="mb-2">
                    <a href="{{ route('banner.create')}}" role="button" class="btn bg-gradient-info btn-lg">{{__('Add Banner')}}</a>
                </div>
                <table id="banner-list-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->file }}</td>
                                <td>{{ $banner->status }}</td>
                                <td>{{ $banner->order }}</td>
                                <td>{{ $banner->created_by }}</td>
                                <td>{{ $banner->created_at }}</td>
                                <td>{{ $banner->updated_at }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder"></i>View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="#">
                                        <i class="fas fa-pencil-alt"></i>Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#">
                                        <i class="fas fa-trash"></i>Delete
                                    </a>
                                </td>
                            </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
    <script src="{{ asset('js/banner.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@stop