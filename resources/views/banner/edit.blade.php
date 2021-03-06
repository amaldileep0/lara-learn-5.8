@extends('layouts.admin_app')

@section('title', 'Update Banner') 
@section('breadcrumbs', Breadcrumbs::render('banner.edit', $banner)) 
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card card-primary">
         <div class="card-header">
            <h3 class="card-title">{{__('Update Banner : '.$banner->title)}}</h3>
         </div>
         <div class="col-md-6">
        <form method="post" action="{{route('banner.update', $banner->id)}}" enctype="multipart/form-data">
        	@method('PATCH') 
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
                  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Title" 
                  value="{{old('title', $banner->title)}}" autofocus name="title"> 
               </div>
              <div class="border-box inline-row">
                <h2>{{ __('Upload Image') }}</h2>
                @if(@empty($banner->file))
                  <img id="banner-image-preview" class="product-image-thumb" src="/img/photos.png"/>
                @else
                  <img id="banner-image-preview" class="product-image-thumb" src="{{asset('storage').$banner->file}}"/>
                @endif
                 <div class="form-group mt-2">
                    <div class="input-group">
                       <div class="custom-file">
                          <input type="file" id="banner-image" class="custom-file-input @error('file') is-invalid @enderror" name="file">
                          <label class="custom-file-label" for="bannerImageInput">{{ __('Replace image') }}</label>
                       </div>
                    </div>
                 </div>
              </div>
               <div class="form-group">
                  <label for="title">{{ __('Order') }}</label>
                  <input type="text" class="form-control @error('order') is-invalid @enderror" id="order" placeholder="Enter Order" 
                  value="{{old('order', $banner->order)}}" name="order"> 
               </div>
               <div class="form-group">
                  <div class="icheck-primary">
                    <input class="form-check-input @error('active') is-invalid @enderror" type="checkbox" 
                    name="active" id="active" value="1" {{old('active', $banner->active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn bg-gradient-primary">{{ __('Update') }}</button>
               <a class="btn bg-gradient-danger" role="button" href="{{ route('banner.index') }}">{{ __('Cancel') }}</a>   
            </div>
         </form>
     </div>
      </div>
   </div>
</div>    
@endsection
@section('pagescript')
    <script src="{{ asset('/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        bsCustomFileInput.init();
      });
    </script>
    <script src="{{ asset('js/banner.js') }}"></script>
@stop