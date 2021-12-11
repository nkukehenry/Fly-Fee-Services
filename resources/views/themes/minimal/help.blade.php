@extends($theme.'layouts.app')
@section('title',trans($title))
@section('content')

    @include($theme.'sections.help')

    @include($theme.'sections.app')

@endsection



