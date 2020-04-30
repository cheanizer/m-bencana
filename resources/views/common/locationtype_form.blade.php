@extends('layouts.administration')

@section('main-content')
    <div class="module">
        <div class="module-head">
            <h3>Input Type Lokasi</h3>
        </div>
        <div class="module-body">
            @include('includes.messages')
            {!! Form::open(['route' => ( \Route::current()->getName() == 'location.type.edit' ? ['location.type.edit.do',$location_type->id] : 'location.type.create.do') ]) !!}
                {!! Form::textLabel('jenis_lokasi',$location_type->jenis_lokasi) !!}
                {!! Form::buttonLabel('Proses')!!}
            {!! Form::close()!!}
        </div>
    </div>
@endsection
