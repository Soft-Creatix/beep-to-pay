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
            <div class="col-lg-6 col-md-6 col-12">
                <div class="pad-first">
                    <img src="{{asset('website/images/company-logo.png')}}" class="img-fluid mb-2" alt="BeepToPay" />
                    <h3 class="pay-heading">Pay with Us</h3>
                    <p class="title-p">One click secure payments under your fingertips</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="pad-second">
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

                        <button type="submit" class="btn-royalblue">Confirm Password</button>
                    </form>

                    <div class="hr-sect font_14 col-grey">Or</div>


                    <div class="text-center">
                        <a href="{{ route('login') }}" class="royal-blue font_16 font-weight-bold">Login</a>
                    </div>
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

