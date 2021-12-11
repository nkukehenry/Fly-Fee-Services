<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Source+Sans+Pro">
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


<section id="main-nav">
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-xl w-100">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{getFile(config('location.logo.path').'logo.png')}}" alt="{{config('basic.site_title')}}">
            </a>
            <div class="d-flex justify-content-between max--sm--100 align-items-center ">
                <div class="send-from pl-2">
                    <label for="send-from"><span class="d-none d-xl-inline-block">{{trans('Send from')}} :</span> <span><img class="sendFromFlag" src="{{@$sendFromCountry->first()->flag}}" alt="flag"></span> </label>
                    <select id="send-from" class="sendFromCountry">
                        @foreach($sendFromCountry as $data)
                            <option value="{{$data['id']}}" data-code="{{$data['code']}}"
                                    data-name="{{$data['name']}}"
                                    data-rate="{{$data['rate']}}"
                                    data-minimum_amount="{{$data['minimum_amount']}}"
                                    data-resource="{{$data}}"
                                    data-flag="{{$data['flag']}}">{{trans($data['name'])}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item {{menuActive('home')}}">
                            <a class="nav-link" href="{{route('home')}}">@lang('Home') </a>
                        </li>
                        <li class="nav-item {{menuActive('how-it-work')}}">
                            <a class="nav-link" href="{{route('how-it-work')}}">{{trans('How it work')}}</a>
                        </li>
                        <li class="nav-item {{menuActive('help')}}">
                            <a class="nav-link" href="{{route('help')}}">{{trans('Help')}}</a>
                        </li>
                        <li class="nav-item {{menuActive('contact')}}">
                            <a class="nav-link" href="{{route('contact')}}">@lang('Contact')</a>
                        </li>
                        @guest
                            <li class="nav-item {{menuActive('login')}}">
                                <a class="nav-link" href="{{route('login')}}">{{trans('Sign In')}}</a>
                            </li>
                            @if(config('basic.registration') == 1)
                            <li class="nav-item {{menuActive('register')}}">
                                <a class="nav-link" href="{{route('register')}}">{{trans('Sign Up')}}</a>
                            </li>
                            @endif
                        @endguest

                    </ul>

                </div>


                <div class="d-flex align-items-center mr-xl-auto">
                    <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="icofont-navigation-menu"></i>
                    </button>

                    @auth
                        @include($theme.'partials.pushNotify')
                        @include($theme.'partials.userAction')
                    @endauth
                </div>

            </div>
        </nav>
        <div class="side-nav">
            <button class="cross">&times;</button>

            <ul class="navbar-nav">
                <li class="nav-item {{menuActive('home')}}">
                    <a class="nav-link" href="{{route('home')}}">@lang('Home') </a>
                </li>
                <li class="nav-item {{menuActive('how-it-work')}}">
                    <a class="nav-link" href="{{route('how-it-work')}}">{{trans('How it work')}}</a>
                </li>
                <li class="nav-item {{menuActive('help')}}">
                    <a class="nav-link" href="{{route('help')}}">{{trans('Help')}}</a>
                </li>
                <li class="nav-item  {{menuActive('contact')}}">
                    <a class="nav-link" href="{{route('contact')}}">@lang('Contact')</a>
                </li>

                @guest
                    <li class="nav-item {{menuActive('login')}}">
                        <a class="nav-link" href="{{route('login')}}">{{trans('Sign In')}}</a>
                    </li>
                    @if(config('basic.registration') == 1)
                        <li class="nav-item {{menuActive('register')}}">
                            <a class="nav-link" href="{{route('register')}}">{{trans('Sign Up')}}</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</section>

@include($theme.'partials.banner')


@yield('content')

@include($theme.'partials.footer')

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
