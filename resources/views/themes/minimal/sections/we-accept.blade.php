@if(isset($templates['we-accept'][0]) && $weAccept = $templates['we-accept'][0])
<section id="payment" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="section-title title-bar">
                <h1>@lang(@$weAccept->description->title)</h1>
            </div>
        </div>
        <div class="payment-methods">
            @foreach($gateways as $gateway)
                <div class="payment-item">
                    <div class="image">
                        <img src="{{getFile(config('location.gateway.path').@$gateway->image)}}"
                             alt="{{@$gateway->name}}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

