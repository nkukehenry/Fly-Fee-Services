@if(isset($templates['send-money-video'][0]) && $sendMoneyVideo = $templates['send-money-video'][0])
    <section id="send-money-video" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300" style="
    background-image: linear-gradient(to right , rgba(56, 80, 129,0.95), rgba(56, 80, 129,0.95)), url({{getFile(config('location.template.path').@$sendMoneyVideo->templateMedia()->image)}});">
        <div class="container">
            <div class="send-money-wrapper">
                <div class="video-button">
                    <button type="button" data-toggle="modal" data-target=".video">
                        <i class="icofont-ui-play"></i>
                    </button>
                    <div class="modal fade video" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <iframe width="560" height="315" src="{{@$sendMoneyVideo->templateMedia()->youtube_link}}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-title">
                    <h1>@lang(@$sendMoneyVideo->description->title)</h1>
                </div>
                <div class="paragraph">
                    <p>@lang(@$sendMoneyVideo->description->short_details)</p>
                </div>
            </div>
        </div>
    </section>
@endif

