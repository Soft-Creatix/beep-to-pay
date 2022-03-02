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
            <div class="col-12 p-0 mt-5 mb-5">
                <div class="container form-container h_100">
                    <img src="{{asset('website/images/company-logo.png')}}" class="img-fluid" alt="BeepToPay">
                    <h3 class="font_18 font-weight-bold mt-4">Verify your phone number</h3>

                    <div class="spinner-border mt-5" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

{{--  --}}
