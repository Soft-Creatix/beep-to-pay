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
                <div class="alert alert-danger alert-dismissible text-center mr-2">
                    <a href="javascript:;" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> {!! session('error') !!}
                </div>
            @endif
            <img src="{{asset('website/images/company-logo.png')}}" class="img-fluid" alt="BeepToPay">
            <h3 class="font_18 font-weight-bold mt-4">Verify your phone number</h3>
            <p class="font_15">We sent you an OTP to your phone number. Enter the code below to continue.</p>
            <form action="{{ route('website.verifyOTP') }}" method="post" class="mt-4 w-60 p-4" id="OTPForm">
                @csrf
               <div class="d-flex bd-highlight">
                  <input type="number" min="0" maxlength="1" name="otp1" class="form-control input-field text-center mr-2" placeholder="0" />
                  <input type="number" min="0" maxlength="1" name="otp2" class="form-control input-field text-center mr-2" placeholder="0" />
                  <input type="number" min="0" maxlength="1" name="otp3" class="form-control input-field text-center mr-2" placeholder="0" />
                  <input type="number" min="0" maxlength="1" name="otp4" class="form-control input-field text-center mr-2" placeholder="0" />
               </div>
               <div class="form-group text-center mr-2 mt-4">
                  <a href="javascript:;" class="royal-blue font_16" onclick="resendOTP()">Resend OTP</a>
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

   $('#el').focus();

   var elements = document.getElementsByClassName('input-field')
    Array.from(elements).forEach(function(element){
        element.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13 || element.value.length == 1) {
                // Focus on the next sibling
                element.nextElementSibling.focus();
            }
        });
    });

    function resendOTP() {
        $.get(`{{ route('website.resendOTP') }}`, function( data ) {
            // $( ".result" ).html( data );
            // alert( "Load was performed." );
        });

    }
</script>
@endpush
