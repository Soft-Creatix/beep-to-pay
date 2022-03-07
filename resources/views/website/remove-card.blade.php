

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
                <div class="container form-container h_100" style="padding: 1.5% 10% !important;">
                    <a href="javascript:;">
                        <img src="{{asset('website/images/arrow.png')}}" class="img-fluid" alt="">
                    </a>
                    <div class="row mt-3">
                        <div class="col-lg-6 col-md-12 col-12 ">
                            <div class="text-left position-relative">
                                <img src="{{asset('website/images/card__box.png')}}" class="img-fluid card-img" alt="">
                                <div class="card-absolute">
                                    <h5 class="font_18 font-weight-bold text-white">Cardholder Name</h5>
                                    <p class="font_18 text-white">Muhammad ***</p>

                                    <div>
                                        <h5 class="font_18 font-weight-bold text-white">Cardholder Name</h5>
                                        <p class="font_18 text-white">**** 0123</p>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button class="btn-red">Remove Card</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush


