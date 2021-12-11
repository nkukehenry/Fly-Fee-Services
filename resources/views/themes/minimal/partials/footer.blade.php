
@if(!Request::routeIs('user*'))
<section id="footer" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
    <div class="container">

        <div class="footer-top">
            @if(isset($contactUs['news-letter']) && $newsLetter = $contactUs['news-letter'][0])
            <div class="subscribe-text">
                <h4>@lang(@$newsLetter->description->title)</h4>
                <span>@lang(@$newsLetter->description->sub_title)</span>
            </div>
            <div class="subscribe-input">
                <form action="{{route('subscribe')}}" method="post">
                    @csrf
                    <div class="footer-form d-flex justify-content-between">
                        <input type="email" name="subscribe_email" placeholder="@lang('Email Address')" autocomplete="off">
                        <button class="subscribe-btn">{{trans('Subscribe')}}</button>
                    </div>
                    @error('subscribe_email')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </form>
            </div>
            @endif
            <div class="social-links">
                @if(isset($contentDetails['social']))
                <ul class="footer-social d-flex justify-content-end">
                    @foreach($contentDetails['social'] as $data)
                    <li><a href="{{@$data->content->contentMedia->description->link}}"><i class="{{@$data->content->contentMedia->description->icon}}"></i></a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        <hr>

        <div class="footer-main">
            <div class="footer-description">
                <div class="logo">
                    <a href="{{route('home')}}">
                    <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="...">
                    </a>
                </div>

                @if(isset($contactUs['contact-us']) &&  $contactData =  $contactUs['contact-us'][0])
                    <div class="paragraph">
                        <p>{{@$contactData->description->footer_left_text}}</p>
                    </div>
                @endif
            </div>

            <div class="footer-important-links">
                <div class="content-title">
                    <h5>{{trans('About Company')}}</h5>
                </div>
                <ul>
                    <li>
                        <a href="{{route('home')}}">@lang('Home')</a>
                    </li>
                    <li>
                        <a href="{{route('about')}}"> @lang('About Us')</a>
                    </li>
                    <li>
                        <a href="{{route('blog')}}">@lang('Blog')</a>
                    </li>
                    <li>
                        <a href="{{route('faq')}}">@lang('FAQ')</a>
                    </li>
                </ul>
            </div>
            <div class="who-we-are">
                <div class="content-title">
                    <h5>{{trans('Useful Links')}}</h5>
                </div>
                <ul>
                    <li>
                        <a href="{{route('contact')}}">@lang('Contact')</a>
                    </li>
                    @isset($contentDetails['support'])
                        @foreach($contentDetails['support'] as $data)
                            <li>
                                <a href="{{route('getLink', [slug(@$data->description->title), @$data->content_id])}}">@lang(@$data->description->title)</a>
                            </li>
                        @endforeach
                    @endisset
                </ul>
            </div>
            @if(isset($contactUs['contact-us']) &&  $contactData =  $contactUs['contact-us'][0])
            <div class="footer-contact-info">
                <div class="content-title">
                    <h5 class="white uppercase">{{trans('Contact')}}</h5>
                </div>
                <ul>
                    <li class="media">
                        <div class="icon">
                            <i class="icofont-location-pin"></i>
                        </div>
                        <div>
                            <span>@lang(@$contactData->description->address)</span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="icon">
                            <i class="icofont-envelope"></i>
                        </div>
                        <div>
                            <span>@lang(@$contactData->description->email)</span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="icon">
                            <i class="icofont-phone"></i>
                        </div>
                        <div>
                            <span>@lang(@$contactData->description->phone)</span>
                        </div>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>
</section>
@endif


<div id="copy-right">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="copy">
                <span>
                    {{trans('Copyright')}} &copy; {{date('Y')}} <a href="{{route('home')}}" class="text-white text-decoration-none">{{$basic->site_title}}</a> {{trans('All Right Reserved.')}}
                </span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="lang">
                    <label for="lang">{{trans('Language')}} :</label>
                    <select id="lang" class="language">
                        @foreach($languages as $language)
                            <option value="{{strtoupper($language->short_name)}}" @if(strtoupper($language->short_name) ==  session()->get('trans')) selected @endif >@lang($language->name)</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="back-to-top show">
    <i class="fas fa-chevron-up"></i>
</div>


@include($theme.'partials.color')


@push('script')
    <script>
        "use strict";
        $(document).ready(function () {
            $("#lang").selectmenu({
                change: function (event, ui) {
                    window.location.href = "{{route('language')}}/" + $(ui.item.element).val()
                }
            });
        });

        $(document).ready(function () {
            let sendSelectId = localStorage.getItem('sendSelectId');
            let sendSelectFlag = localStorage.getItem('sendSelectFlag');
            let sendSelectName = localStorage.getItem('sendSelectName');
            if (sendSelectId) {
                $('.sendFromCountry').val(sendSelectId).selectmenu("refresh")
                $('.sendFromFlag').attr('src', sendSelectFlag)
            }
        });



        $(".sendFromCountry").selectmenu({
            change: function (event, ui) {
                let id = $(this).val();
                let flag = $(ui.item.element).data('flag');
                let name = $(ui.item.element).data('name');
                let code = $(ui.item.element).data('code');
                let resource = $(ui.item.element).data('resource');
                localStorage.setItem('sendSelectId', id);
                localStorage.setItem('sendSelectFlag', flag);
                localStorage.setItem('sendSelectName', name);
                localStorage.setItem('sendSelectCode', code);
                localStorage.setItem('resource', JSON.stringify(resource));
                $('.sendFromCountry').val(id).selectmenu("refresh")
                $('.sendFromFlag').attr('src', flag)

                window.location.href = "{{url()->current()}}"
            }
        });
    </script>
@endpush
