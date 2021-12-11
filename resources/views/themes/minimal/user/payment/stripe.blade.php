@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection


@section('content')

    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        .btn-info {
            color: #fff;
            background-color: #1fd3c6!important;
            border-color: #1fd3c6!important;
        }
    </style>


    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-md-10">
                    <div class="card secbg ">
                        <div class="card-body d-flex flex-wrap text-center align-items-center">
                            <div>
                                <img src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}" class=" img-thumbnail mx-auto w-75" alt="..">
                            </div>

                            <div>
                                <h4 class="mt-2">@lang('Please Pay') {{getAmount($order->final_amount,config('basic.fraction_number'))}} {{$order->gateway_currency}}</h4>
                                <h4 class="mt-1">@lang('To Get') {{getAmount($order->amount,config('basic.fraction_number'))}}  {{$basic->currency}}</h4>
                                <form action="{{$data->url}}" method="{{$data->method}}">
                                    <script
                                        src="{{$data->src}}"
                                        class="stripe-button"
                                        @foreach($data->val as $key=> $value)
                                        data-{{$key}}="{{$value}}"
                                        @endforeach>
                                    </script>
                                </form>

                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    @push('script')
        <script>
            "use strict";
            $(document).ready(function () {
                $('button[type="submit"]').removeClass("stripe-button-el").addClass("btn  btn-info btn-lg mt-2").find('span').css('min-height', 'initial');
            })
        </script>
    @endpush

@endsection




