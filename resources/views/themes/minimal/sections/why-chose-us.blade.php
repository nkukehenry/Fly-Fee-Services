@if(isset($templates['why-chose-us']) && $whyChoseUs = $templates['why-chose-us'][0])
    <section id="why-choose-us"  class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="section-title title-bar">
                    <h1> @lang(@$whyChoseUs->description->title)</h1>
                </div>
            </div>

            @if(isset($contentDetails['why-chose-us']))
            <div class="row">
                @foreach($contentDetails['why-chose-us'] as $item)
                <div class=" col-md-6 col-lg-4">
                    <div class="choose-card-wrapper">
                        <div class="choose-card">
                            <div class="icon">
                                <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="icon">
                            </div>
                            <div class="content-title">
                                <h4>@lang(@$item->description->title)</h4>
                            </div>
                            <div class="paragraph">
                                <p>@lang(@$item->description->short_description)</p>
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

