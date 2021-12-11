<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @include('partials.seo')

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/bootstrap.min.css')}}">
    @stack('css-lib')
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/icofont.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/nice-select.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/bootstrap-select.min.css')}} ">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/styles.css')}}">
    @stack('style')


    <script src="{{asset($themeTrue.'js/modernizr.custom.js')}}"></script>
</head>

<body>

<div class="loader">
    <img src="{{asset($themeTrue.'images/loader.gif')}}" alt="loader">
</div>


<div id="entry">
    <div class="entry-wrapper">
        <div class="entry-left" style="background-image: linear-gradient(to right , rgba(56, 80, 129,0.95), rgba(56, 80, 129,0.95)), url({{getFile(config('location.logo.path').'banner.jpg') ? : 0}});">
            <div class="container-fluid">
                <div class="entry-left-inner">
                    <a class="logo" href="{{route('home')}}">
                        <img src="{{getFile(config('location.logo.path').'admin-logo.png')}}" alt="{{config('basic.site_title')}}">
                    </a>
                    @if(isset($formContent['form-right-content'][0]) && $getContent = $formContent['form-right-content'][0])
                    <div class="paragraph">
                        <p>@lang(@$getContent->description->details)</p>

                    </div>
                    <a href="{{@$getContent->templateMedia()->button_link}}"><span>@lang(@$getContent->description->button_name) </span></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="entry-right">
            <div class="container-fluid">

                @yield('content')

            </div>

        </div>
    </div>
    <div class="copy-alt">
       <span>
            {{trans('Copyright')}} &copy; {{date('Y')}} <a href="{{route('home')}}" class="text-dark text-decoration-none">{{$basic->site_title}}</a> {{trans('All Right Reserved.')}}
       </span>
    </div>
</div>


<script src="{{asset($themeTrue.'js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/popper-1.12.9.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery-ui.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/bootstrap.min.js')}}"></script>
@stack('extra-js')

<script src="{{asset($themeTrue.'js/notiflix-aio-2.7.0.min.js')}}"></script>


<script src="{{asset($themeTrue.'js/wow.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/select2.full.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/slick.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/bootstrap-select.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/fontawesome.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/script.js')}}"></script>

<script src="{{asset($themeTrue.'js/pusher.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/vue.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/axios.min.js')}}"></script>


@stack('script')

@include($theme.'partials.notification')

</body>
</html>
