@extends($theme.'layouts.form')
@section('title',trans('Forget Password'))

@section('content')

    <div class="entry-right-inner">
        <form action="{{ route('password.email') }}"   method="post">
            @csrf
            <div class="content-title">
                <h3>@lang('Forget Password')</h3>
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

            <div class="form-group">
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                <label for="email">@lang('Email Address')</label>
                <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="@lang('Your Email Address')">

                @error('email')
               <span class="text-danger  mt-1">&nbsp; {{ trans($message) }} </span>

                @enderror
            </div>
            <div class="remember d-flex flex-wrap justify-content-start align-items-center mt-3">
                <a href="{{ route('register') }}" class="font-14 text-dark"> @lang("Don't have any account?") <span class="text--base">@lang('Sign Up')</span></a>
            </div>

            <div class="entry-button">
                <button>@lang('Send Password Reset Link')</button>
            </div>
        </form>
    </div>


@endsection
