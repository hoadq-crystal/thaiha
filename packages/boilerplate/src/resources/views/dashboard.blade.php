@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::layout.dashboard'),
    'subtitle' => '',
    'breadcrumb' => ['']]
)

@section('content')
    @include('boilerplate::home')
@endsection
