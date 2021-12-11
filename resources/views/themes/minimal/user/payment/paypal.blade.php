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
                                <img
                                    src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}"
                                    class="img-thumbnail mx-auto w-75" alt="..">
                            </div>
                            <div>
                                <h5 class="my-4 ">@lang('Please Pay') {{getAmount($order->final_amount, config('basic.fraction_number'))}} {{trans($order->gateway_currency)}} @lang('To Get') {{getAmount($order->amount, config('basic.fraction_number'))}}  {{trans($basic->currency)}}</h5>

                                <div id="paypal-button-container" ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script src="https://www.paypal.com/sdk/js?client-id={{$data->cleint_id}}&currency={{$data->currency}}"></script>
        <script>
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [
                            {
                                description: "{{ $data->description }}",
                                custom_id: "{{ $data->custom_id }}",
                                amount: {
                                    currency_code: "{{trim($data->currency)}}",
                                    value: "{{ $data->amount }}",
                                    breakdown: {
                                        item_total: {
                                            currency_code: "{{trim($data->currency)}}",
                                            value: "{{ $data->amount }}"
                                        }
                                    }
                                }
                            }
                        ]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        var trx = "{{ $data->custom_id }}";
                        window.location = '{{ url('payment/paypal')}}/' + trx + '/' + details.id
                    });
                }
            }).render('#paypal-button-container');
        </script>
    @endpush
@endsection
