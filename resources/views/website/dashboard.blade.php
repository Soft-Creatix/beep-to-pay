{{--  --}}

@extends('website.layouts.app')

@section('title', 'Beep To Pay')
@section('meta_title', '')
@section('meta_description', '')
@section('meta_keywords', '')

@push('styles')
@endpush

@section('content')
    <div class="container mb-5-p">
        <div class="row">
            <div class="col-12 p-0">
                <div class="container form-container" style="padding: 1.5% 10% !important;">
                    <h3 class="font_16 font-weight-bold mt-3">My Cards</h3>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="text-center">
                                <img src="{{asset('website/images/card__box.png')}}" class="img-fluid card-img" alt="">
                                <div class="mt-2">
                                    <a href="remove-card.html" class="font_14 royal-blue">Remove Card</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 add-card">
                            <div>
                                <button class="button-unset">
                                    <img src="{{asset('website/images/add.png')}}" class="img-fluid" alt="">
                                    <br>
                                    <span class="font_14 greyee">Add new card</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <h3 class="font_16 font-weight-bold mt-4">My Transactions</h3>

                </div>
                <div class="container grey-container">
                    <h5 class="font_12 m-0">MONDAY, 10 JANUARY 2022</h5>
                </div>
                <div class="container form-container" style="padding: 1% 10% !important;">

                    <a href="receipt.html">
                        <div class="d-flex bd-highlight py-2">
                            <div class="bd-highlight">
                                <img src="{{asset('website/images/res_1.png')}}" class="img-fluid res-img" alt="">
                            </div>
                            <div class="pl-2 pr-2 flex-grow-1 bd-highlight jus-center"><span class="font_14 greyee">The
                                    Coffee Bean & Tea Leaf</span></div>
                            <div class="bd-highlight text-right jus-center">
                                <h5 class="m-0 greyee font_14 font-weight-bold">$6.00</h5>
                                <p class="m-0 font_12">13:52</p>
                            </div>

                        </div>
                    </a>
                    <a href="receipt.html">
                        <div class="d-flex bd-highlight py-2">
                            <div class="bd-highlight">
                                <img src="{{asset('website/images/res_2.png')}}" class="img-fluid res-img" alt="">
                            </div>
                            <div class="pl-2 pr-2 flex-grow-1 bd-highlight jus-center"><span
                                    class="font_14 greyee">KFC</span></div>
                            <div class="bd-highlight text-right jus-center">
                                <h5 class="m-0 greyee font_14 font-weight-bold">$68.00</h5>
                                <p class="m-0 font_12">12:52</p>
                            </div>

                        </div>
                    </a>
                    <a href="receipt.html">
                        <div class="d-flex bd-highlight py-2">
                            <div class="bd-highlight">
                                <img src="{{asset('website/images/res_3.png')}}" class="img-fluid res-img" alt="">
                            </div>
                            <div class="pl-2 pr-2 flex-grow-1 bd-highlight jus-center"><span class="font_14 greyee">Excapade
                                    Sushi</span></div>
                            <div class="bd-highlight text-right jus-center">
                                <h5 class="m-0 greyee font_14 font-weight-bold">$12.00</h5>
                                <p class="m-0 font_12">11:02</p>
                            </div>

                        </div>
                    </a>
                </div>
                <div class="container grey-container">
                    <h5 class="font_12 m-0">SUNDAY, 9 JANUARY 2022</h5>
                </div>
                <div class="container form-container" style="padding: 1% 10% !important;">

                    <a href="receipt.html">
                        <div class="d-flex bd-highlight py-2">
                            <div class="bd-highlight">
                                <img src="{{asset('website/images/res_1.png')}}" class="img-fluid res-img" alt="">
                            </div>
                            <div class="pl-2 pr-2 flex-grow-1 bd-highlight jus-center"><span class="font_14 greyee">The
                                    Coffee Bean & Tea Leaf</span></div>
                            <div class="bd-highlight text-right jus-center">
                                <h5 class="m-0 greyee font_14 font-weight-bold">$6.00</h5>
                                <p class="m-0 font_12">13:52</p>
                            </div>

                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

{{--  --}}
