@if(isset($templates['way-to-send'][0]) && $wayToSend = $templates['way-to-send'][0])
    <section id="way-to-send" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="section-title title-bar">
                    <h1>@lang(@$wayToSend->description->title)</h1>
                </div>
            </div>
            @if(isset($contentDetails['way-to-send']))
            <div class="row">
                @foreach($contentDetails['way-to-send'] as $key => $item)
                <div class="col-md-6 col-lg-3">
                    <div class="steps-card">
                        <div class="icon ">
                            <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="steps image">
                        </div>
                        <div class="content-title">
                            <h4>{{++$key}} @lang(@$item->description->title)</h4>
                        </div>
                        <div class="paragraph">
                            <p>@lang(@$item->description->short_description)</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
@endif

