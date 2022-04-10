

@extends('website.layouts.app')

@section('title', 'Beep To Pay')
@section('meta_title', '')
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
               <h3 class="font_18 font-weight-bold mt-4">Hooray! One last step</h3>
               <p class="font_15"> Your account’s safety is our number one priority.<br/>
                Set a Payment PIN for your account to be used when checking out.</p>
               <form action="{{ route('website.payment-pin.set') }}" method="post" class="mt-4 w-60 p-4" id="paymentPinForm">
                   @csrf
                  <div class="d-flex bd-highlight">
                     <input type="text" min="0" maxlength="4" name="pin" value="{{ base64_decode(auth()->user()->card_pin) }}" class="form-control input-field mr-2" placeholder="Card pin..." />
                  </div>
                  <input type="submit" class="btn-royalblue mt-4" />
               </form>
            </div>
         </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#paymentPinForm").validate({
             errorClass: "is-invalid",
             validClass: "is-valid"
         });
    });
 </script>
@endpush




