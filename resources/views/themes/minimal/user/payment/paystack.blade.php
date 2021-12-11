@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection
@section('content')



    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card secbg text-center">
                        <div class="card-body d-flex flex-wrap text-center align-items-center">
                            <div>
                                <img src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}" class=" img-thumbnail mx-auto w-75" alt="..">
                            </div>

                            <div>
                                <h4 class="mt-2">@lang('Please Pay') {{getAmount($order->final_amount,config('basic.fraction_number'))}} {{$order->gateway_currency}}</h4>
                                <h4 class="mt-1">@lang('To Get') {{getAmount($order->amount,config('basic.fraction_number'))}}  {{$basic->currency}}</h4>
                                <button type="button" class="cmn-btn btn btn-info btn-lg w-100  mt-2"
                                        id="btn-confirm">@lang('Pay Now')</button>

                                <form
                                    action="{{ route('ipn', [optional($order->gateway)->code, $order->transaction]) }}"
                                    method="POST">
                                    @csrf
                                    <script
                                        src="//js.paystack.co/v1/inline.js"
                                        data-key="{{ $data->key }}"
                                        data-email="{{ $data->email }}"
                                        data-amount="{{$data->amount}}"
                                        data-currency="{{$data->currency}}"
                                        data-ref="{{ $data->ref }}"
                                        data-custom-button="btn-confirm">
                                    </script>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

