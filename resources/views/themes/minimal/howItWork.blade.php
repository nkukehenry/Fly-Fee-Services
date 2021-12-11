@extends($theme.'layouts.app')
@section('title',trans($title))
@section('content')

    @include($theme.'sections.way-to-send')
    @include($theme.'sections.send-money-video')
    @include($theme.'sections.why-chose-us')



    @include($theme.'sections.family-support')
    @include($theme.'sections.we-accept')

@endsection



