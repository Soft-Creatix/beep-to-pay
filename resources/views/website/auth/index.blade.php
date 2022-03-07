@extends('website.layouts.app')
@section('title', 'Login')
@section('meta_title', 'Login')
@section('meta_description', '')
@section('meta_keywords', '')
@push('styles')
@endpush
@section('content')
<div class="container">
   <div class="row">
      <div class="col-lg-6 col-md-6 col-12">
         <div class="pad-first">
            <img src="{{ asset('website/images/company-logo.png') }}" class="img-fluid mb-2" alt="BeepToPay" />
            <h3 class="pay-heading">Pay with Us</h3>
            <p class="title-p">One click secure payments under your fingertips</p>
         </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12">
         <div class="pad-second">
            @if ($errors->has('email'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    {{ $errors->first('email') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" id="loginForm">
               @csrf
               <div class="form-group">
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control input-field" placeholder="Email or Phone Number" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" />
               </div>
               <div class="form-group position-relative">
                  <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control input-field" placeholder="Password" data-rule-required="true" data-msg-required="Please enter a password" />
                  <div class="absolute-eye">
                     <a href="javascript:;" onclick="event.preventDefault(); myFunction();"><i class="fa fa-eye eyeIcon"
                        aria-hidden="true"></i></a>
                  </div>
                  @if ($errors->has('password'))
                  <label class="error" for="email">{{ $errors->first('password') }}</label>
                  @endif
               </div>
               <div class="form-group form-check p-0">
                  <div class="d-flex bd-highlight">
                     <div class="flex-fill bd-highlight">
                        <input type="checkbox" class="m-0" id="exampleCheck1" />
                        <label class="form-check-label font_14" for="exampleCheck1">Remember me</label>
                     </div>
                     <div class="flex-fill bd-highlight text-right">
                        <a href="{{ route('password.request') }}" class="font_14 royal-blue font-weight-bold">Forgot password?</a>
                     </div>
                  </div>
               </div>
               <button type="submit" class="btn-royalblue">Log In</button>
            </form>
            <div class="hr-sect font_14 col-grey">OR</div>
            <div class="text-center">
               <a href="{{ route('website.register') }}" class="royal-blue font_16 font-weight-bold">Register</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
   function myFunction() {
       var x = document.getElementById("password");
       if (x.type === "password") {
           $(".eyeIcon").toggleClass("fa-eye-slash");
           x.type = "text";
       } else {
           $(".eyeIcon").toggleClass("fa-eye-slash");
           x.type = "password";
       }
   }

   $(document).ready(function() {
        $("#loginForm").validate({
            errorClass: "is-invalid",
            validClass: "is-valid"
        });
   });
</script>
@endpush
