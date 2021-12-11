@extends($theme.'layouts.form')
@section('title',trans('Sign Up'))

@section('content')

    <div class="entry-right-inner">
        <form action="{{ route('register') }}" method="post" onsubmit="return submitUserForm();">
            @csrf

            <div class="content-title">
                <h3>{{trans('Sign Up')}}</h3>
            </div>
            @if(session()->get('sponsor') != null)
            <label for="sponsor">@lang('Sponsor Name')</label>
            <input type="text" name="sponsor"  id="sponsor"  value="{{session()->get('sponsor')}}" placeholder="{{trans('Sponsor By') }}" readonly>
                @error('sponsor')<span class="text-danger  mt-1">{{ trans($message) }}</span>@enderror
            @endif


            <label for="firstname" class="mt-2">@lang('First Name')</label>
            <input type="text" id="firstname" name="firstname" value="{{old('firstname')}}" placeholder="@lang('First Name')">
            @error('firstname')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror


            <label for="lastname" class="mt-2">@lang('Last Name')</label>
            <input type="text" id="lastname" name="lastname" value="{{old('lastname')}}" placeholder="@lang('Last Name')">
            @error('lastname')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror

            <label for="username" class="mt-2">@lang('Username')</label>
            <input type="text" id="username" name="username" value="{{old('username')}}" placeholder="@lang('Username')">
            @error('username')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror


            <label for="email" class="mt-2">@lang('Email Address')</label>
            <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="@lang('Email Address')">
            @error('email')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror


            <label for="phone" class="mt-2">@lang('Phone Number')</label>
            <input type="text" id="phone" name="phone" value="{{old('phone')}}" placeholder="@lang('Phone Number')">
            @error('phone')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror



            <label for="password" class="mt-2">@lang('Password')</label>
            <div class="d-flex justify-content-between password-visual">
                <input type="password"  id="password" name="password"  value="{{old('password')}}" placeholder="@lang('Password')">

                <div class="input-group-append ">
                    <span class="show-password input-group-text" id="inputGroup-sizing-default">
                        <a href="javascript:void(0)"
                           class="text-white  clickShowPassword">
                            <i class="fa fa-eye-slash"></i>
                        </a>
                    </span>
                </div>
            </div>
            @error('password')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror


            <label for="password_confirmation">@lang('Confirm Password')</label>

            <div class="d-flex justify-content-between password-visual">
                <input type="password"  id="password_confirmation" name="password_confirmation"  value="{{old('password_confirmation')}}" placeholder="@lang('Confirm Password')">

                <div class="input-group-append ">
                    <span class="show-password input-group-text" id="inputGroup-sizing-default">
                        <a href="javascript:void(0)"
                           class="text-white  clickShowPassword">
                            <i class="fa fa-eye-slash"></i>
                        </a>
                    </span>
                </div>
            </div>


            @if(config('basic.google_captcha') == 1)
                <label for="recaptcha" class="form-label mt-2">&nbsp;</label>
                <div>
                    <div class="g-recaptcha ms-3" id="recaptcha"
                         data-sitekey="{{config('basic.google_captcha_key')}}"></div>
                    <span id="captcha" class="text-danger ms-3"></span>
                </div>
            @endif

            <div class="entry-button">
                <button>@lang('Sign Up')</button>
            </div>
        </form>
        <div class="content-title text-center my-2">
            <span>{{trans('Or')}}</span>
        </div>
        <p class="login-link text-center">@lang("Already have an account?") <a href="{{ route('login')}}"><span class="text--base"> @lang('Sign In')</span></a></p>
    </div>


@endsection


@push('style')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var isCapcha = "{{config('basic.google_captcha')}}"
            if (isCapcha == '0') {
                return true
            }

            var v = grecaptcha.getResponse();
            if (v.length == 0) {
                document.getElementById('captcha').innerHTML = "{{trans('Captcha field is required.')}}";
                document.getElementById('captcha').classList.remove("text-info");
                document.getElementById('captcha').classList.add("text-danger");
                return false;
            } else {
                document.getElementById('captcha').innerHTML = "{{trans('Captcha completed')}}";
                document.getElementById('captcha').classList.remove("text-danger");
                document.getElementById('captcha').classList.add("text-info");
                return true;
            }
        }


        $(document).on('click', '.clickShowPassword', function () {
            var passInput = $(this).closest('.password-visual').find('input');
            if (passInput.attr('type') === 'password') {
                $(this).children().removeClass('fa-eye-slash');
                $(this).children().addClass('fa-eye');
                passInput.attr('type', 'text');
            } else {
                $(this).children().removeClass('fa-eye');
                $(this).children().addClass('fa-eye-slash');
                passInput.attr('type', 'password');
            }
        })
    </script>
@endpush
