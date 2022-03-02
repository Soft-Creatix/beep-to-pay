{{--  --}}

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
                    <img src="{{ asset('website/images/company-logo.png') }}" class="img-fluid mb-2" alt="BeepToPay" />
                    <h3 class="pay-heading">Pay with Us</h3>
                    <p class="title-p">One click secure payments under your fingertips</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="pad-second">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control input-field" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Email or Phone Number" />
                        </div>
                        <div class="form-group position-relative">
                            <input type="password" name="password" class="form-control input-field" id="myInput" placeholder="Password" />
                            <div class="absolute-eye">
                                <a href="#" onclick="event.preventDefault(); myFunction();"><i class="fa fa-eye eyeIcon"
                                        aria-hidden="true"></i></a>
                            </div>
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

                    <div class="hr-sect font_14 col-grey">Or</div>


                    <div class="text-center">
                        <a href="{{ route('website.register') }}" class="royal-blue font_16 font-weight-bold">Register</a>
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
                $(".eyeIcon").toggleClass("fa-eye-slash");
                x.type = "text";
            } else {
                $(".eyeIcon").toggleClass("fa-eye-slash");
                x.type = "password";
            }
        }
    </script>
@endpush

{{--  --}}
