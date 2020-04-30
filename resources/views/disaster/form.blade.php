@extends('layouts.administration')

@section('main-content')
<div class="module">
    <div class="module-head">
        <h3>Input Bencana</h3>
    </div>
    <div class="module-body">
        @include('includes.messages')
        {!! Form::open(['route' => \Route::current()->getName() == 'disaster.edit' ? ['disaster.edit.do',$disaster->bencanaid] : 'disaster.create.do','class' => 'form-horizontal row-fluid']) !!}
            {!! Form::textLabel('bencana',$disaster->bencana,'Nama') !!}
            {!! Form::textAreaLabel('deskripsi',$disaster->deskripsi,'Deskripsi',['rows' => '4','class' => 'span8'])!!}
            {!! Form::datePickerLabel('mulai',($disaster->mulai ? $disaster->mulai->format('d/n/Y') : '' ),'Mulai') !!}
            {!! Form::selectLabel('status',['' => 'Pilih', '1' => 'Aktif' , '0' => 'Non-Aktif'],$disaster->status)!!}
            <div class="control-group">
                {{Form::label('default','Default',['class' => 'control-label'])}}
                <div class="controls">
                    <label class="checkbox inline">
                        {!!Form::checkbox('default',1,$disaster->default)!!}
                    </label>
                </div>
            </div>
            {!! Form::buttonLabel('Proses')!!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
