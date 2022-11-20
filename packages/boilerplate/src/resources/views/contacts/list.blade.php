@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::contacts.title'),
    'subtitle' => __('boilerplate::contacts.list.title'),
    'breadcrumb' => [
        __('boilerplate::contacts.title') => 'boilerplate.contacts.index'
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{ route('boilerplate.contacts.create') }}" class="btn btn-primary">
                    @lang('boilerplate::contacts.create.title')
                </a>
            </span>
        </div>
    </div>
    @component('boilerplate::card')
        @component('boilerplate::datatable', ['name' => 'contacts']) @endcomponent
    @endcomponent
@endsection

@push('css')
    <style>.img-circle { border:1px solid #CCC }</style>
@endpush
