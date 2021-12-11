@extends($theme.'layouts.app')
@section('title',trans($title))

@section('content')
    @include($theme.'sections.about-us')
    @include($theme.'sections.services')
    @include($theme.'sections.mission-and-vision')
    @include($theme.'sections.send-money-video')
    @include($theme.'sections.why-chose-us')

    @include($theme.'sections.we-accept')


@endsection
