@extends('layouts.admin_app')

@section('title', 'Add Banner') 
@section('breadcrumbs', Breadcrumbs::render('banner.create')) 
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card card-primary">
         <div class="card-header">
            <h3 class="card-title">{{__('Create new banner')}}</h3>
         </div>
         <div class="col-md-6">
        <form method="post" action="{{route('banner.store')}}" enctype="multipart/form-data">
        	@csrf
            <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
               <div class="form-group">
                  <label for="title">{{ __('Title') }}</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Title" value="{{ old('title') }}" autofocus name="title"> 
               </div>
               <div class="form-group">
                  <label for="exampleInputFile">{{ __('Upload Image') }}</label>
                  <div class="input-group">
                     <div class="custom-file">
                        <input type="file" class="custom-file-input @error('title') is-invalid @enderror" name="file" id="banner-image">
                        <label class="custom-file-label" for="bannerImageInput">{{ __('Choose Image') }}</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn bg-gradient-primary">{{ __('Save') }}</button>
               <a class="btn bg-gradient-danger" role="button" href="{{ route('banner.index') }}">{{ __('Cancel') }}</a>   
            </div>
         </form>
     </div>
      </div>
   </div>
</div>    
@endsection
@section('pagescript')
    <script src="{{ asset('js/banner.js') }}"></script>
@stop