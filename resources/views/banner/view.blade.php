@extends('layouts.admin_app')

@section('title', 'View Banner') 
@section('breadcrumbs', Breadcrumbs::render('banner.show', $banner)) 
@section('content')
 <!-- Default box -->
<div class="card card-solid">
    <div class="card-body">
        <div class="row">
        	 <div class="col-12 col-sm-6">
        	 	<div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              		<h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{$banner->title}}</h3>
              		<div class="text-muted">
              			<p class="text-sm">Banner Status
		                  <b class="d-block">@if($banner->active) 
		                  	<span class="badge badge-success">Enabled</span>
		                  	@else 
		              		<span class="badge badge-danger">Disabled</span>
		              		@endif</b>
		                </p>
		                <p class="text-sm">Created By
		                  <b class="d-block">{{$banner->createdBy->name}}</b>
		                </p>
		                <p class="text-sm">Created At
		                  <b class="d-block">{{$banner->created_at}}</b>
		                </p>
		                <p class="text-sm">Updated At
		                  <b class="d-block">{{$banner->updated_at}}</b>
		                </p>
		                <p class="text-sm">Banner Order
		                  <b class="d-block">{{$banner->order}}</b>
		                </p>
		             </div>
          		</div>
        	 </div>
            <div class="col-12 col-sm-6">
                <a href="{{asset('storage').$banner->file}}" data-toggle="lightbox" data-title="{{$banner->title}}">
                   <img src="{{asset('storage').$banner->file}}" class="img-fluid mb-2" alt="banner-image"/>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script>
  	$(function () {
    	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
	      event.preventDefault();
	      $(this).ekkoLightbox({
	        alwaysShowClose: true
	      });
    	});
  	})
</script>
@stop