@extends('website.layouts.app')
@section('title', 'Register')
@section('meta_title', '')
@section('meta_description', '')
@section('meta_keywords', '')
@push('styles')
<style>
    #phone_number-error {
        margin-left: -20%;
    }
</style>
@endpush
@section('content')
<div class="container">
   <div class="row">
      <div class="col-12 p-0 mt-5 mb-5">
         <div class="container form-container">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p><strong>Error!</strong></p>
                    @foreach ($errors->all() as $error)
                        <p>&#9679; {{ $error }}</p>
                    @endforeach
                </div>
            @endif
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
               kept confidential.
            </p>
            <form class="mt-4 w-70" method="POST" action="{{ route('website.register') }}" id="registerForm">
               @csrf
               <h4 class="font_16 font-weight-bold">Account Information</h4>
               <div class="form-group">
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control input-field" placeholder="Name" data-rule-required="true" data-msg-required="Please enter a name" />
               </div>
               <div class="form-group">
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control input-field" placeholder="Email" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" />
               </div>
               <div class="form-group position-relative">
                  <input type="password" name="password" value="{{ old('password') }}" class="form-control input-field" id="myInput"
                     placeholder="Password" data-rule-required="true" data-rule-minlength="8" data-rule-pwcheck="true" data-msg-required="Please enter a password" />
                  <div class="absolute-eye">
                     <a href="#" onclick="event.preventDefault(); myFunction();"><i class="fa fa-eye eyeIcon"
                        aria-hidden="true"></i></a>
                  </div>
               </div>
               <div class="form-group">
                  <input type="password" name="confirm_password" value="{{ old('confirm_password') }}" class="form-control input-field"
                     placeholder="Confirm Password" data-rule-required="true" data-msg-required="Please enter a confirm password" />
               </div>
               <div class="form-group">
                  <div class="d-flex bd-highlight">
                     <div class="bd-highlight">
                        <select class="form-select code-select" aria-label="Default select example" name="phone_code">
                           <option value="+673" selected>+673</option>
                           <option value="+674">+674</option>
                           <option value="+675">+675</option>
                           <option value="+676">+676</option>
                           <option value="+92">+92</option>
                        </select>
                     </div>
                     <div class="flex-fill bd-highlight">
                        <input type="number" name="phone_number" value="{{ old('phone_number') }}" class="form-control phoneno-input"
                           placeholder="Phone number" data-rule-required="true" data-msg-required="Please enter a phone number" />
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <input type="text" name="identity_card" value="{{ old('identity_card') }}" class="form-control input-field"
                     placeholder="Identity Card (I.C)" data-rule-required="true" data-msg-required="Please enter an identity card number" />
               </div>
               <div class="form-group">
                  <!-- <input type="date" class="form-control input-field" placeholder="Date of Birth" /> -->
                  <input placeholder="Date of Birth" name="dob" value="{{ old('dob') }}" class="form-control input-field" type="text"
                     onfocus="(this.type='date')" id="date" style="display: flex;
                     justify-content: center;
                     align-items: center;
                     margin: auto;" data-rule-required="true" data-msg-required="Please enter the date of birth">
               </div>
               <div class="form-group">
                  {{-- <input type="text" name="gender" value="{{ old('gender') }}" class="form-control input-field" placeholder="Gender" data-rule-required="true" data-msg-required="Please enter a gender" /> --}}
                    <select name="gender" class="form-control">
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Others" {{ old('gender') == 'Others' ? 'selected' : '' }}>Others</option>
                    </select>
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
   $(document).ready(function() {
        $.validator.addMethod("pwcheck", function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
        });
        $.validator.messages.pwcheck = "Password can only be uppercase, lowercase, special characters(=!\-@._*) and digits";
        $("#registerForm").validate();
   });
</script>
@endpush
