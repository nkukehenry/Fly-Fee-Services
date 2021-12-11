@extends($theme.'layouts.app')
@section('title',trans($title))
@section('content')

    @include($theme.'sections.calculation')
    @include($theme.'sections.why-chose-us')
    @include($theme.'sections.app')
    @include($theme.'sections.way-to-send')
    @include($theme.'sections.send-money-video')
    @include($theme.'sections.testimonial')
    @include($theme.'sections.support')
    @include($theme.'sections.faq')
    @include($theme.'sections.family-support')
    @include($theme.'sections.blog')
    @include($theme.'sections.we-accept')

@endsection



