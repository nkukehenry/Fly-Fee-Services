@if(isset($templates['app'][0]) && $app = $templates['app'][0])


    <section id="app" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 d-flex">
                    <div class="app-image">
                        <div class="image">
                            <img src="{{getFile(config('location.template.path').@$app->templateMedia()->image)}}" alt="app image">
                        </div>
                        <div class="overlayer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="app-content">
                        <div class="section-title">
                            <h1>@lang(@$app->description->title)</h1>
                        </div>
                        <div class="paragraph">
                            <p>@lang(@$app->description->short_description)</p>
                        </div>

                        <div class="app-buttons">
                            <a href="{{@$app->templateMedia()->app_link}}" class="app-store media">
                                <img src="{{asset($themeTrue.'images/apple-logo.png')}}" alt="apple">
                                <div>
                                    <span class="on">{{trans('Download On')}}</span>
                                    <span class="store">{{trans('App Store')}}</span>
                                </div>
                            </a>
                            <a href="{{@$app->templateMedia()->playstore_link}}" class="app-store media">
                                <img src="{{asset($themeTrue.'images/google-play.png')}}" alt="google-play">
                                <div>
                                    <span class="on">{{trans('Download On')}}</span>
                                    <span class="store">{{trans('Google Play')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endif

