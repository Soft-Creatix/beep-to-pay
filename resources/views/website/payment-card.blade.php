

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
            <img src="{{asset('website/images/company-logo.png')}}" class="img-fluid" alt="BeepToPay">
            <h3 class="font_18 font-weight-bold mt-4">Congratulations!</h3>
            <p class="font_15">
                Your account has been created. Add your debit or credit card to start using Beep To Pay
            </p>

            <form action="javascript:;" class="mt-5 w-60">

                <h4 class="font_16 font-weight-bold">Add Debit or Credit Card!</h4>
                <div class="form-group mt-3">
                    <input type="text" class="form-control input-field" placeholder="Card number">
                </div>
                <div class="form-group">
                    <div class="d-flex bd-highlight w-90">
                        <div class="pr-3 flex-fill bd-highlight"><input type="text" class="form-control input-field text-left" placeholder="MM" /></div>
                        <div class="pr-3 flex-fill bd-highlight"><input type="text" class="form-control input-field text-left" placeholder="YY" /></div>
                        <div class="flex-fill bd-highlight"><input type="text" class="form-control input-field text-left" placeholder="CVV" /></div>
                      </div>
                </div>
                  <div class="form-group">
                    <input type="text" class="form-control input-field" placeholder="Cardholder name">
                </div>
                <div class="form-group text-center mt-4">

                    <a href="{{ route('website.confirm-info') }}" type="submit" class="btn-royalblue">Save Card</a>
                </div>

            </form>
           </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush


