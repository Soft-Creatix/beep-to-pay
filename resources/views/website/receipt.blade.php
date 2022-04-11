

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
                <div class="container form-container">
                    <a href="{{ url()->previous() }}">
                        <img src="{{asset('website/images/arrow.png')}}" class="img-fluid" alt="">
                    </a>
                    <div class="row mt-3">
                        <div class="col-12">
                            <h5 class="font_16 greyee font-weight-bold">Receipt</h5>

                            <div class="text-center mt-5">
                                <img src="{{ $transaction->vendor_image }}" class="res-img" alt="">

                                <h3 class="font_16 greyee mt-3">{{ $transaction->vendor_name }}</h3>

                                <button class="btn-green mt-3">{{ $transaction->status }}</button>

                                <div class="container receipt-cart text-left mt-4 mb-5">
                                    <div class="d-flex bd-highlight py-2">
                                        <div class="p-2 flex-fill bd-highlight font_14 greyee w-50">Total Amount</div>
                                        <div class="p-2 flex-fill bd-highlight font-weight-bold font_15 w-50">BND {{ $transaction->total_amount }}</div>
                                    </div>
                                    <div class="d-flex bd-highlight py-2">
                                        <div class="p-2 flex-fill bd-highlight font_14 greyee w-50">Date</div>
                                        <div class="p-2 flex-fill bd-highlight font-weight-bold font_15 w-50">{{ $transaction->created_at->format('d-m-Y h:i A') }}</div>
                                    </div>

                                    <div class="d-flex bd-highlight py-2">
                                        <div class="p-2 flex-fill bd-highlight font_14 greyee w-50">Payment Method</div>
                                        <div class="p-2 flex-fill bd-highlight font-weight-bold font_15 w-50">BIBD
                                            Mastercard (992)</div>
                                    </div>
                                    <div class="d-flex bd-highlight py-2">
                                        <div class="p-2 flex-fill bd-highlight font_14 greyee w-50">Transaction ID</div>
                                        <div class="p-2 flex-fill bd-highlight font-weight-bold font_15 w-50">
                                            {{ $transaction->id }}</div>
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


