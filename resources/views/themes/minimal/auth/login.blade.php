@extends($theme.'layouts.form')
@section('title',trans('Sign In'))

@section('content')

    <div class="entry-right-inner">
        <form action="{{ route('login') }}" method="post" onsubmit="return submitUserForm();">
            @csrf
            <div class="content-title">
                <h3>@lang('Login Form')</h3>
            </div>

          <label for="username">@lang('Email Or Username')</label>
          <input type="text" id="username" name="username" value="{{old('username')}}" placeholder="@lang('Email Or Username')">
          @error('username')<span class="text-danger  mt-1">{{ trans($message) }}</span>@enderror
          @error('email')<span class="text-danger  mt-1">{{ trans($message) }}</span>@enderror


            <label for="password" class="mt-2">@lang('Password')</label>
            <div class="d-flex justify-content-between password-visual">
                <input type="password"  id="password" name="password"  value="{{old('password')}}"  placeholder="@lang('Password')">
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



            @if(config('basic.google_captcha') == 1)
                    <label for="recaptcha" class="form-label">&nbsp;</label>
                    <div>
                        <div class="g-recaptcha ms-3" id="recaptcha"
                             data-sitekey="{{config('basic.google_captcha_key')}}"></div>
                        <span id="captcha" class="text-danger ms-3"></span>
                    </div>

            @endif


            <div class="remember d-flex flex-wrap justify-content-between align-items-center mt-3">
                <div class="checkbox">
                    <input type="checkbox" name="remember" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">@lang('Remember Me')</label>
                </div>
                <a href="{{ route('password.request') }}" class="forget">@lang("Forgot password?")</a>
            </div>
            <div class="entry-button">
                <button>@lang('Sign In')</button>
            </div>
        </form>
        <div class="content-title text-center my-2">
            <span>{{trans('Or')}}</span>
        </div>
        <p class="login-link text-center">@lang("Don't have an account?") <a href="{{ route('register')}}"><span class="text--base"> @lang('Sign Up')</span></a></p>

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

