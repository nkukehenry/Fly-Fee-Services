@if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])

    <section id="testimonial" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="section-title title-bar">
                    <h1>@lang(@$testimonial->description->title)</h1>
                </div>
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    @if(isset($contentDetails['testimonial']))
                        @foreach($contentDetails['testimonial'] as $key=>$data)

                    <div class="carousel-item {{($key == 0) ? "active":""}} ">
                        <div class="client-card-wrapper">
                            <div class="client-card">
                                <div class="d-flex justify-content-center">
                                    <div class="client-image">
                                        <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="client image">
                                    </div>
                                </div>
                                <div class="client-info">
                                    <div class="name">
                                        <span>@lang(@$data->description->name)</span>
                                    </div>
                                    <hr>
                                    <div class="designation">
                                        <span>@lang(@$data->description->designation)</span>
                                    </div>
                                    <div class="paragraph">
                                        <p>
                                            @lang(@$data->description->description)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif

                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <i class="icofont-rounded-left"></i>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <i class="icofont-rounded-right"></i>
                </a>
            </div>
        </div>
    </section>
@endif
