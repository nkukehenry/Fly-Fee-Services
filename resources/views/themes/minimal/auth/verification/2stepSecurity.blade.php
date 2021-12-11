@extends($theme.'layouts.form')
@section('title',trans($page_title))

@section('content')
    <div class="entry-right-inner">
        <form action="{{route('user.twoFA-Verify')}}"  method="post">
            @csrf
            <div class="content-title">
                <h3>{{trans($page_title)}}</h3>
            </div>

            <div class="form-group">
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <label for="code">@lang('Enter Code')</label>
                <input type="text" id="code"  name="code" value="{{old('code')}}"/>
                @error('code')<span class="text-danger  mt-1">{{ trans($message) }}</span>@enderror
                @error('error')<span class="text-danger  mt-1">{{ trans($message) }}</span>@enderror
            </div>

            <div class="entry-button">
                <button>@lang('Submit')</button>
            </div>
        </form>
    </div>
@endsection
