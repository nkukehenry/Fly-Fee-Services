@if(isset($templates['mission-and-vision'][0]) && $mission= $templates['mission-and-vision'][0])
    <section id="mission-and-vision" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 d-flex">
                    <div class="image-wrapper">
                        <div class="image">
                            <img src="{{getFile(config('location.template.path').@$mission->templateMedia()->image)}}" alt="Mission and vision">
                        </div>
                        <div class="overlayer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content">
                        <div class="section-title">
                            <h1>@lang(@$mission->description->title)</h1>
                        </div>
                        <div class="paragraph">
                            <p>
                                @lang(@$mission->description->description)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

