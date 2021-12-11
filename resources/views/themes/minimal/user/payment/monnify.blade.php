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
                                    class=" img-thumbnail mx-auto w-75" alt="..">
                            </div>

                            <div>
                                <h4 class="mt-2 ">@lang('Please Pay') {{getAmount($order->final_amount,config('basic.fraction_number'))}} {{trans($order->gateway_currency)}}</h4>
                                <h4 class="mb-1 ">@lang('To Get') {{getAmount($order->amount,config('basic.fraction_number'))}}  {{trans($basic->currency)}}</h4>
                                <button class="cmn-btn btn btn-info btn-lg  mt-2"
                                        onclick="payWithMonnify()">@lang('Pay via Monnify')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('script')
    <script type="text/javascript" src="//sdk.monnify.com/plugin/monnify.js"></script>
    <script type="text/javascript">
        function payWithMonnify() {
            MonnifySDK.initialize({
                amount: {{ $data->amount ?? '0' }},
                currency: "{{ $data->currency ?? 'NGN' }}",
                reference: "{{ $data->ref }}",
                customerName: "{{$data->customer_name ?? 'John Doe'}}",
                customerEmail: "{{$data->customer_email ?? 'example@example.com'}}",
                customerMobileNumber: "{{ $data->customer_phone ?? '0123' }}",
                apiKey: "{{ $data->api_key }}",
                contractCode: "{{ $data->contract_code }}",
                paymentDescription: "{{ $data->description }}",
                isTestMode: true,
                onComplete: function (response) {
                    if (response.paymentReference) {
                        window.location.href = '{{ route('ipn', ['monnify', $data->ref]) }}';
                    } else {
                        window.location.href = '{{ route('failed') }}';
                    }
                },
                onClose: function (data) {
                }
            });
        }
    </script>
    @endpush
@endsection
