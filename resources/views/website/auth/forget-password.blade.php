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
                <img src="{{asset('website/images/company-logo.png')}}" class="img-fluid mb-2" alt="BeepToPay" />
                <h3 class="pay-heading">Pay with Us</h3>
                <p class="title-p">One click secure payments under your fingertips</p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="pad-second">
                <form>
                    <div class="form-group">
                        <input type="email" class="form-control input-field" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email or Phone Number" />
                    </div>


                    <button type="submit" class="btn-royalblue">Forget Password</button>
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

@endpush

{{--  --}}
