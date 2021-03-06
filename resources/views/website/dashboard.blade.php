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
            <div class="col-12 p-0 mt-5 mb-5">
                <div class="container form-container" style="padding: 0.5% 10% !important;">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    <h3 class="font_16 font-weight-bold mt-3">My Cards</h3>
                    @if(count($cards))
                        @foreach ($cards as $card)
                        <div class="row mt-3">
                            <div class="col-6">
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
                                        <a href="{{ route('website.remove-card', $card->id) }}" class="btn-del btn-red">Remove Card</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 add-card">
                                <div>
                                    <a href="{{ route('website.payment-card') }}" class="button-unset">
                                        <img src="{{ asset('website/images/add.png') }}" class="img-fluid" alt="">
                                        <br>
                                        <span class="font_14 greyee">Add new card</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="row mt-3">
                        <div class="col-6">
                            No cards available!
                        </div>
                        <div class="col-6 add-card">
                            <div>
                                <a href="{{ route('website.payment-card') }}" class="button-unset">
                                    <img src="{{ asset('website/images/add.png') }}" class="img-fluid" alt="">
                                    <br>
                                    <span class="font_14 greyee">Add new card</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    <hr />
                    <h3 class="font_16 font-weight-bold mt-2">My Transactions</h3>
                    <hr />
                </div>
                {{-- <div class="container grey-container">
                    <h5 class="font_12 m-0">MONDAY, 10 JANUARY 2022</h5>
                </div> --}}
                <div class="container form-container" style="padding: 0% 10% !important; padding-bottom: 5% !important;">
                    @if(count($transactions))
                        @foreach ($transactions as $transaction)
                            <a href="{{ route('website.receipt', $transaction->id) }}">
                                <div class="d-flex bd-highlight py-2">
                                    <div class="bd-highlight">
                                        <img src="{{ $transaction->vendor_image }}" class="img-fluid res-img" alt="">
                                    </div>
                                    <div class="pl-2 pr-2 flex-grow-1 bd-highlight jus-center"><span class="font_14 greyee">The
                                        {{ $transaction->vendor_name }}</span></div>
                                    <div class="bd-highlight text-right jus-center">
                                        <h5 class="m-0 greyee font_14 font-weight-bold">BND {{ $transaction->total_amount }}</h5>
                                        <p class="m-0 font_12">{{ $transaction->created_at->format('d-m-Y h:i A') }}</p>
                                    </div>

                                </div>
                            </a>
                        @endforeach
                    @else
                        <div>No Transactions Available!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
