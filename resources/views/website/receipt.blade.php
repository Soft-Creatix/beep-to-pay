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
                    <a href="#">
                        <img src="{{asset('website/images/arrow.png')}}" class="img-fluid" alt="">
                    </a>
                    <div class="row mt-3">
                        <div class="col-12">
                            <h5 class="font_16 greyee font-weight-bold">Receipt</h5>

                            <div class="text-center mt-5">
                                <img src="{{asset('website/images/res-logo.png" alt="">

                                <h3 class="font_16 greyee mt-3">The Coffee Bean & Tea Leaf</h3>

                                <button class="btn-green mt-3">SUCCESS</button>

                                <div class="container receipt-cart text-left mt-4 mb-5">
                                    <div class="d-flex bd-highlight py-2">
                                        <div class="p-2 flex-fill bd-highlight font_14 greyee w-50">Amount</div>
                                        <div class="p-2 flex-fill bd-highlight font-weight-bold font_15 w-50">BND30.00</div>
                                    </div>
                                    <div class="d-flex bd-highlight py-2">
                                        <div class="p-2 flex-fill bd-highlight font_14 greyee w-50">Date</div>
                                        <div class="p-2 flex-fill bd-highlight font-weight-bold font_15 w-50">5th April 2020
                                            13:53</div>
                                    </div>

                                    <div class="d-flex bd-highlight py-2">
                                        <div class="p-2 flex-fill bd-highlight font_14 greyee w-50">Payment Method</div>
                                        <div class="p-2 flex-fill bd-highlight font-weight-bold font_15 w-50">BIBD
                                            Mastercard (992)</div>
                                    </div>
                                    <div class="d-flex bd-highlight py-2">
                                        <div class="p-2 flex-fill bd-highlight font_14 greyee w-50">Transaction ID</div>
                                        <div class="p-2 flex-fill bd-highlight font-weight-bold font_15 w-50">
                                            T412380020087645</div>
                                    </div>
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

{{--  --}}
