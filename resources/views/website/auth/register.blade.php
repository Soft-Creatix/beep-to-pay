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
            <div class="col-12 p-0">
                <div class="container form-container">

                    {{-- 'name' => $data['name'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'password' => Hash::make($data['password']),
                    'identity_card' => $data['identity_card'],
                    'dob' => $data['dob'],
                    'gender' => Hash::make($data['gender']), --}}
                    <img src="{{ asset('website/images/company-logo.png') }}" class="img-fluid" alt="BeepToPay">
                    <h3 class="font_18 font-weight-bold mt-4">Registration</h3>
                    <p class="font_15">To get started, we just need a few things from you, and we promise they are
                        kept confidential.</p>
                    <form class="mt-4 w-70" method="POST" action="{{ route('website.register') }}">
                        @csrf
                        <h4 class="font_16 font-weight-bold">Account Information</h4>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control input-field" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control input-field" placeholder="Email" />
                        </div>
                        <div class="form-group position-relative">
                            <input type="password" name="password" class="form-control input-field" id="myInput"
                                placeholder="Password" />
                            <div class="absolute-eye">
                                <a href="#" onclick="event.preventDefault(); myFunction();"><i class="fa fa-eye eyeIcon"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm_password" class="form-control input-field"
                                placeholder="Confirm Password" />

                        </div>
                        <div class="form-group">
                            <div class="d-flex bd-highlight">
                                <div class="bd-highlight">
                                    <select class="form-select code-select" aria-label="Default select example">
                                        <option selected>+673</option>
                                        <option value="1">+674</option>
                                        <option value="2">+675</option>
                                        <option value="3">+676</option>
                                    </select>
                                </div>
                                <div class="flex-fill bd-highlight">
                                    <input type="number" name="phone_number" class="form-control phoneno-input"
                                        placeholder="Phone number" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="identity_card" class="form-control input-field"
                                placeholder="Identity Card (I.C)" />

                        </div>
                        <div class="form-group">
                            <!-- <input type="date" class="form-control input-field" placeholder="Date of Birth" /> -->
                            <input placeholder="Date of Birth" name="dob" class="form-control input-field" type="text"
                                onfocus="(this.type='date')" id="date" style="    display: flex;
                                justify-content: center;
                                align-items: center;
                                margin: auto;">

                        </div>
                        <div class="form-group">
                            <input type="text" name="gender" class="form-control input-field" placeholder="Gender" />

                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn-royalblue" value="Register Now" />
                        </div>
                        <div class="form-group text-center">

                            <a href="{{ route('login') }}" class="royal-blue font_16">Cancel and return</a>
                        </div>

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
