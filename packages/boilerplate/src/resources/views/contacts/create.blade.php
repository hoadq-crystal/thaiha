@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::contacts.title'),
    'subtitle' => __('boilerplate::contacts.create.title'),
    'breadcrumb' => [
        __('boilerplate::contacts.title') => 'boilerplate.contacts.index',
        __('boilerplate::contacts.create.title')
    ]
])
@include('boilerplate::load.fileinput')
@section('content')
    {{ Form::open(['route' => 'boilerplate.contacts.createContact', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
        <div class="row justify-content-center">
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
            <div class="col-lg-12">
                    @component('boilerplate::card', ['title' => 'boilerplate::contacts.informations'])
                        <div class="w-50 mx-auto">
                            <div class="row">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::contacts.name','id' => 'title','onkeyup' => 'ChangeToSlug()', 'autofocus' => true])@endcomponent
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    @component('boilerplate::input', ['name' => 'phone','id' => 'phone', 'label' => 'boilerplate::contacts.phone'])@endcomponent
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-12">
                                        @component('boilerplate::input', ['name' => 'email', 'label' => 'boilerplate::contacts.email','id' => 'email'])@endcomponent
                                        @component('boilerplate::input', ['name' => 'address', 'label' => 'boilerplate::contacts.address','id' => 'address'])@endcomponent
                                    </div>
                                </div>
                            @component('boilerplate::input', ['name' => 'dataContent','type' => 'textarea','rows' => '4', 'id' => 'dataContent', 'label' => 'boilerplate::contacts.content'])@endcomponent
                        </div>
                    @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection
