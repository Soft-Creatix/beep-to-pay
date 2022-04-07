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
                    <a href="{{ route('website.dashboard') }}">
                        <img src="{{ asset('website/images/arrow.png') }}" class="img-fluid" alt="">
                    </a>
                    <div class="row mt-3">
                        <div class="col-lg-6 col-md-12 col-12 ">
                            <div class="text-left position-relative">
                                <img src="{{ asset('website/images/card__box.png') }}" class="img-fluid card-img" alt="">
                                <div class="card-absolute">
                                    <h5 class="font_18 font-weight-bold text-white">Cardholder Name</h5>
                                    <p class="font_18 text-white">{{ str_pad(substr($card->cardholder_name, 0, 6), 12, '*', STR_PAD_RIGHT) }}<p>

                                    <div>
                                        <h5 class="font_18 font-weight-bold text-white">Cardholder Name</h5>
                                        <p class="font_18 text-white">{{ str_pad(substr($card->card_number, 15, 4), 20, '*', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('website.delete-card', $card->id) }}"
                                        onclick="return confirm('Confirm delete card?')" class="btn-del btn-red">Remove
                                        Card</a>
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
