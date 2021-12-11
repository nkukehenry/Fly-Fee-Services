@if(isset($templates['support'][0]) && $support = $templates['support'][0])
<section id="support" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="support-content">
                    <div class="section-title">
                        <h1>@lang(@$support->description->title)</h1>
                    </div>
                    <div class="paragraph">
                        <p>@lang(@$support->description->short_details)</p>
                    </div>
                    <div class="get-strated">
                        <a href="{{@$support->templateMedia()->button_link}}" class="anim-button">
                            <span class="layer1">@lang(@$support->description->button_name)</span>
                            <span class="layer2"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="support-image-wrapper">
                    <div class="support-image-lg">
                        <div class="image">
                            <img src="{{getFile(config('location.template.path').@$support->templateMedia()->image)}}" alt="support image">
                        </div>
                        <div class="overlayer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
