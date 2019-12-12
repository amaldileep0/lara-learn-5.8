@extends('layouts.not_signed_ui')
@section('content')
<div class="card">
   <div class="card-body register-card-body">
      <p class="login-box-msg">{{ __('Register') }}</p>
      <form method="POST" action="{{ route('register') }}">
         @csrf
         <div class="input-group mb-3">
            <input id="name" type="text" placeholder="Enter Full Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            <div class="input-group-append">
               <div class="input-group-text">
                  <span class="fas fa-user"></span>
               </div>
            </div>
            @error('name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="input-group mb-3">
            <input id="email" type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            <div class="input-group-append">
               <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
               </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="input-group mb-3">
            <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <div class="input-group-append">
               <div class="input-group-text">
                  <span class="fas fa-lock"></span>
               </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="input-group mb-3">
            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <div class="input-group-append">
               <div class="input-group-text">
                  <span class="fas fa-lock"></span>
               </div>
            </div>
         </div>
         <div class="row">
            <!-- /.col -->
            <div class="col-12">
               <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
            </div>
            <!-- /.col -->
         </div>
      </form>
      @guest
      <p class="mt-2">
         <a class="text-center" href="{{ route('login') }}">{{ __('I already have an account ?') }}</a>   
      </p>
      @endguest             
   </div>
   <!-- /.form-box -->
</div>
<!-- /.card -->
@endsection