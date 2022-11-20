@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::contacts.title'),
    'subtitle' => __('boilerplate::contacts.edit.title'),
    'breadcrumb' => [
        __('boilerplate::contacts.title') => 'boilerplate.contacts.index',
        __('boilerplate::contacts.edit.title')
    ]
])
@include('boilerplate::load.fileinput')
@include('boilerplate::load.tinymce')
@push('js')
    <script>
        $('#tiny').tinymce({});
    </script>
@endpush
@section('content')
    {{ Form::open(['route' => ['boilerplate.contacts.update', $contact->id], 'method' => 'put', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route('boilerplate.contacts.index') }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::contacts.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('boilerplate::contacts.save')
                    </button>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                @component('boilerplate::card', ['title' => __('boilerplate::contacts.informations')])
                @csrf
                    <div class="w-50 mx-auto">
                        <div class="row">
                            <div class="col-md-6 col-lg-12 col-xl-6">
                                @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::contacts.name', 'id' => 'name','onkeyup' => 'ChangeToSlug()', 'value' => $contact->name])@endcomponent
                            </div>
                            <div class="col-md-6 col-lg-12 col-xl-6">
                                @component('boilerplate::input', ['name' => 'phone','id' => 'phone', 'label' => 'boilerplate::contacts.phone', 'value' => $contact->phone])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'email', 'label' => 'boilerplate::contacts.email','id' => 'email', 'value' => $contact->email])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'address', 'label' => 'boilerplate::contacts.address','id' => 'address', 'value' => $contact->address])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'contentData','id' => 'contentData','type' => 'textarea','rows' => '4', 'label' => 'boilerplate::contacts.content', 'value' => $contact->content])@endcomponent
                            </div>
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection
