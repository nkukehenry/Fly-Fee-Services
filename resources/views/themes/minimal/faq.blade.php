@extends($theme.'layouts.app')
@section('title', trans('FAQ'))

@section('content')
    @include($theme.'sections.faq')
    @include($theme.'sections.family-support')

@endsection
