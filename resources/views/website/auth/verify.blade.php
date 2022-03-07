@extends('website.layouts.app')
@section('title', 'Verify')
@section('meta_title', 'Verify')
@section('meta_description', '')
@section('meta_keywords', '')
@push('styles')
@endpush
@section('content')
<div class="container">
   <div class="row">
      <div class="col-12 p-0 mt-5 mb-5">
         <div class="container form-container h_75">
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> {!! session('error') !!}
                </div>
            @endif
            <img src="{{asset('website/images/company-logo.png')}}" class="img-fluid" alt="BeepToPay">
            <h3 class="font_18 font-weight-bold mt-4">Verify your phone number</h3>
            <p class="font_15">We sent you an OTP to your phone number. Enter the code below to continue.</p>
            <form action="{{ route('website.verifyOTP') }}" method="post" class="mt-4 w-60 p-4" id="OTPForm">
                @csrf
               <div class="d-flex bd-highlight">
                  <div class="p-2 flex-fill bd-highlight"><input type="text" name="otp1" class="form-control input-field text-center" placeholder="0" /></div>
                  <div class="p-2 flex-fill bd-highlight"><input type="text" name="otp2" class="form-control input-field text-center" placeholder="0" /></div>
                  <div class="p-2 flex-fill bd-highlight"><input type="text" name="otp3" class="form-control input-field text-center" placeholder="0" /></div>
                  <div class="p-2 flex-fill bd-highlight"><input type="text" name="otp4" class="form-control input-field text-center" placeholder="0" /></div>
               </div>
               <div class="form-group text-center mt-4">
                  <a href="javascript:;" class="royal-blue font_16">Resend OTP</a>
               </div>
               <input type="submit" class="btn-royalblue" />
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
   $(document).ready(function() {
       $("#OTPForm").validate();
   });
</script>
@endpush
