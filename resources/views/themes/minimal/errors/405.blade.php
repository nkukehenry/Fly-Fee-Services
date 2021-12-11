@extends($theme.'layouts.app')
@section('title',trans('405'))


@section('content')
<section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-12 text-center">
                <span class="display-1 d-block">{{trans('405')}}</span>
                <div class="mb-4 lead">{{trans("Method Not Allowed")}}</div>
                <a class="btn btn-info btn-lg" href="{{url('/')}}" >@lang('Back To Home')</a>
            </div>
        </div>
    </div>
</section>
@endsection
