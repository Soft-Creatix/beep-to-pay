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
                <div class="container form-container h_100">
                    <img src="{{asset('website/images/company-logo.svg')}}" class="img-fluid" alt="BeepToPay">
                    <h3 class="font_18 font-weight-bold mt-4">Hooray! One last step</h3>
                    <p class="font_15">
                        Your account’s safety is our number one priority.

                        Set a Payment PIN for your account to be used when checking out.
                    </p>
                    <form action="#" class="mt-4 w-60 p-4">
                        <div class="d-flex bd-highlight">
                            <div class="p-2 flex-fill bd-highlight"><input type="text"
                                    class="form-control input-field text-center" placeholder="0" /></div>
                            <div class="p-2 flex-fill bd-highlight"><input type="text"
                                    class="form-control input-field text-center" placeholder="0" /></div>
                            <div class="p-2 flex-fill bd-highlight"><input type="text"
                                    class="form-control input-field text-center" placeholder="0" /></div>
                            <div class="p-2 flex-fill bd-highlight"><input type="text"
                                    class="form-control input-field text-center" placeholder="0" /></div>
                        </div>
                        <div class="form-group text-center mt-4">

                            <a href="payment-card.html" type="submit" class="btn-royalblue">Save</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

{{--  --}}
