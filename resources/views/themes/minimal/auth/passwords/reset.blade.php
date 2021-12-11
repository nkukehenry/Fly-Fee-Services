@extends($theme.'layouts.form')
@section('title',trans('Reset Password'))

@section('content')

    <div class="entry-right-inner">
        <form action="{{ route('password.update') }}"   method="post">
            @csrf
            <div class="content-title">
                <h3>@lang('Reset Password')</h3>
            </div>

            @if (session('status'))
                <div class="input--group">
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        {{ trans(session('status')) }}
                        <button type="button" class="close text-right" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <label for="password">@lang('New Password')</label>
            <input type="password" id="password" name="password" value="" placeholder="{{trans('******')}}">
            @error('password')<span class="text-danger  mt-1">{{ trans($message) }}</span>@enderror

            <label for="email">@lang('Confirm Password')</label>
            <input type="password" id="password" name="password_confirmation" value="" placeholder="{{trans('******')}}">


            <div class="remember d-flex flex-wrap justify-content-start align-items-center mt-3">
                <a href="{{ route('register') }}" class="font-14 text-dark"> @lang("Don't have any account?") <span class="text--base">@lang('Sign Up')</span></a>
            </div>
            <div class="entry-button">
                <button>@lang('Update Password')</button>
            </div>
        </form>
    </div>






@endsection
