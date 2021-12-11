@if(isset($templates['about-us'][0]) && $aboutUs= $templates['about-us'][0])

    <section id="about" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6 d-flex">
                    <div class="app-image">
                        <div class="image">
                            <img src="{{getFile(config('location.template.path').@$aboutUs->templateMedia()->image)}}" alt="about video">
                        </div>
                        <div class="overlayer">
                        </div>
                        <div class="play-button">
                            <div class="video-button">
                                <button type="button" data-toggle="modal" data-target=".about-video">
                                    <i class="icofont-ui-play"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="app-content">
                        <div class="section-title">
                            <h1>@lang(@$aboutUs->description->title)</h1>
                        </div>
                        <div class="paragraph">
                            <p>
                                @lang(@$aboutUs->description->short_description)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade about-video" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <iframe width="560" height="315" src="{{@$aboutUs->templateMedia()->youtube_link}}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endif

