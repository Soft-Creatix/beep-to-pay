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
                    <img src="{{ asset('website/images/company-logo.png') }}" class="img-fluid" alt="BeepToPay">
                    <h3 class="font_18 font-weight-bold mt-4">Congratulations!</h3>
                    <p class="font_15">
                        Your account has been created. Add your debit or credit card to start using Beep To Pay
                    </p>
                    <div class="message-div"></div>
                    <form action="javascript:;" class="mt-5 w-60" method="post" id="paymentform"
                        onsubmit="return false">
                        @csrf
                        <h4 class="font_16 font-weight-bold">Add Debit or Credit Card!</h4>
                        <div class="form-group mt-3">
                            <input type="number" name="card_number" class="form-control input-field"
                                placeholder="Card number" data-rule-required="true" data-rule-minlength="16"
                                data-msg-required="Please enter your card number">
                        </div>
                        <div class="form-group">
                            <div class="d-flex bd-highlight w-90">
                                <div class="pr-3 flex-fill bd-highlight"><input type="number"
                                        class="form-control input-field text-left" name="month" placeholder="MM"
                                        data-rule-required="true" data-msg-required="Please enter card month"
                                        data-rule-minlength="2" /></div>
                                <div class="pr-3 flex-fill bd-highlight"><input type="number"
                                        class="form-control input-field text-left" name="year" placeholder="YY"
                                        data-rule-required="true" data-msg-required="Please enter your card year"
                                        data-rule-minlength="2" /></div>
                                <div class="flex-fill bd-highlight"><input type="number"
                                        class="form-control input-field text-left" name="cvv" placeholder="CVV"
                                        data-rule-required="true" data-msg-required="Please enter your card cvv"
                                        data-rule-minlength="3" /></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-field" name="cardholder_name"
                                placeholder="Cardholder name" data-rule-required="true"
                                data-msg-required="Please enter card holder name" data-rule-minlength="2">
                        </div>
                        <div class="form-group text-center mt-4">

                            <button type="submit" class="btn-royalblue">Save
                                Card</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#paymentform").validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                submitHandler: function(form) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('website.add-payment-card') }}",
                        data: $(form).serialize(),
                        success: function(res) {
                            if (res === 'false') {
                                $('.message-div').html(
                                    '<div class="alert alert-danger">Card Already Exists.</div>'
                                )
                            } else {
                                $('.message-div').html(
                                    '<div class="alert alert-success">Card Created Successfully.</div>'
                                );
                                setTimeout(() => {
                                    window.location =
                                        "{{ route('website.dashboard') }}";
                                }, 1000);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endpush
