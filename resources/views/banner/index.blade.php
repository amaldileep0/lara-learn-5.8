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
                            <th>Action</th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td class="project-actions text-left">
                                    <a href="{{ route('banner.show', $banner->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-folder"></i>
                                        View
                                    </a>
                                    <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                         Edit
                                    </a>
                                    <div class="mt-2">
                                        <form action="{{ route('banner.destroy', $banner->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $banner->id }}</td>
                                <td><img src="{{asset('storage'.$banner->file)}}" class="product-image-thumb" alt="banner-image"></td>
                                <td>{{ $banner->title }}</td>
                                <td> 
                                    @if($banner->active == '1')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif

                                </td>
                                <td>{{ $banner->order }}</td>
                                <td>{{ $banner->createdBy->name }}</td>
                                <td>{{ $banner->created_at }}</td>
                                <td>{{ $banner->updated_at }}</td>
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