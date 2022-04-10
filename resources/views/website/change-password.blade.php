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
               <h3 class="font_18 font-weight-bold mt-4">Change Password</h3>
               <p class="font_15"> You can change your password from here</p>
               <form action="{{ route('website.payment-pin.set') }}" method="post" class="mt-4 w-60 p-4" id="paymentPinForm">
                   @csrf
                   <form>

                    <div class="form-group position-relative">
                        <input type="password" class="form-control input-field" id="myInput"
                            placeholder="Old Password" />
                        <div class="absolute-eye">
                            <a href="javascript:;" onclick="event.preventDefault(); myFunction();"><i class="fa fa-eye eyeIcon"
                                    id="eyeIcon" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="form-group position-relative">
                        <input type="password" class="form-control input-field" id="myInput2"
                            placeholder="New Password" />
                        <div class="absolute-eye">
                            <a href="javascript:;" onclick="event.preventDefault(); myFunction2();"><i class="fa fa-eye eyeIcon"
                                    id="eyeIcon2" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="form-group position-relative">
                        <input type="password" class="form-control input-field" id="myInput3"
                            placeholder="Confirm Password" />
                        <div class="absolute-eye">
                            <a href="javascript:;" onclick="event.preventDefault(); myFunction3();"><i class="fa fa-eye eyeIcon"
                                    id="eyeIcon3" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <button type="submit" class="btn-royalblue">Update Password</button>
                </form>
            </div>
         </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                $("#eyeIcon").toggleClass("fa-eye-slash");
                x.type = "text";
            } else {
                $("#eyeIcon").toggleClass("fa-eye-slash");
                x.type = "password";
            }
        }

        function myFunction2() {
            var x = document.getElementById("myInput2");
            if (x.type === "password") {
                $("#eyeIcon2").toggleClass("fa-eye-slash");
                x.type = "text";
            } else {
                $("#eyeIcon2").toggleClass("fa-eye-slash");
                x.type = "password";
            }
        }

        function myFunction3() {
            var x = document.getElementById("myInput3");
            if (x.type === "password") {
                $("#eyeIcon3").toggleClass("fa-eye-slash");
                x.type = "text";
            } else {
                $("#eyeIcon3").toggleClass("fa-eye-slash");
                x.type = "password";
            }
        }
    </script>
@endpush

