@if(isset($templates['services'][0]) && $service= $templates['services'][0])
    <section id="services" class="services wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="section-title title-bar">
                    <h1>@lang(@$service->description->title)</h1>
                </div>
            </div>
            @if(isset($contentDetails['services']))
                <div class="row">
                    @foreach($contentDetails['services'] as $key=>$data)
                        <div class=" col-md-6 col-lg-4">
                            <div class="choose-card-wrapper">
                                <div class="choose-card">
                                    <div class="icon">
                                        <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="icon">
                                    </div>
                                    <div class="content-title">
                                        <h4>@lang($data->description->title)</h4>
                                    </div>
                                    <div class="paragraph">
                                        <p>@lang($data->description->description)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endif
