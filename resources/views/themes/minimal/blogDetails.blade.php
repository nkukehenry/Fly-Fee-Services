@extends($theme.'layouts.app')
@section('title',trans('Blog Details'))

@section('content')

    <section id="blog-details" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-left">
                        <div class="blog-card-wrapper">
                            <div class="blog-card">
                                <div class="blog-image">
                                    <img src="{{$singleItem['image']}}" alt="{{$singleItem['title']}}">
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
                                            <h3>{{$singleItem['title']}}</h3>
                                        </div>
                                        <div class="paragraph">
                                            <p>@lang($singleItem['description'])</p>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-details-right">

                        @if(isset($popularContentDetails['blog']))
                        <div class="recent-news-wrapper">
                            <div class="content-title">
                                <h3>{{trans('Recent Post')}}</h3>
                            </div>
                            <div class="recent-news d-flex flex-column">
                                @foreach($popularContentDetails['blog']->take(4)->sortDesc() as $data)
                                <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}" class="post d-flex align-items-center">
                                    <div class="post-image">
                                        <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="post img" class="w-100">
                                    </div>
                                    <div class="post-details d-flex flex-column justify-content-between h-100">
                                        <div class="date">
                                            <span>{{dateTime($data->created_at)}}</span>
                                        </div>
                                        <div class="post-heading">
                                            <span>{{\Str::limit($data->description->title,35)}}</span>
                                        </div>
                                    </div>
                                </a>
                                @endforeach

                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
