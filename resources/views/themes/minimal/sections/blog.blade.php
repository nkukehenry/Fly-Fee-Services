<section id="blog" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
    <div class="container">
        @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
            <div class="d-flex justify-content-center">
                <div class="section-title title-bar">
                    <h1>@lang(@$blog->description->title)</h1>
                </div>
            </div>
        @endif

        @if(isset($contentDetails['blog']))
            <div class="blog-slider">
                @foreach($contentDetails['blog']->take(6)->sortDesc() as $data)
                <div class="blog-card-wrapper">
                    <div class="blog-card">
                        <div class="blog-image">
                            <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="blog image">
                        </div>
                        <div class="blog-content">
                            <div class="author-and-date">
                                <div class="name media align-items-center">
                                    <span>{{trans('By Admin')}}</span>
                                </div>
                                <div class="date">
                                    <span>{{dateTime(@$data->created_at)}}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="blog-content-main">
                                <div class="blog-heading">
                                    <h3>{{\Str::limit(@$data->description->title,40)}}</h3>
                                </div>
                                <div class="paragraph">
                                    <p>{{\Str::limit(strip_tags(@$data->description->description),120)}}</p>
                                </div>
                                <div class="read-more-button">
                                    <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="anim-button">
                                        <span class="layer1">{{trans('READ MORE')}}</span>
                                        <span class="layer2"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        @endif
    </div>
</section>
