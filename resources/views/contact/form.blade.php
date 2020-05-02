@extends('layouts.administration')

@section('main-content')
    <div class="module">
        <div class="module-head">
            <h3>{{\Route::current()->getName() == 'contact.edit' ? 'Edit' : 'Input'}} Kontak</h3>
        </div>
        <div class="module-body">
            @include('includes.messages')
            {!! Form::open(['route' => \Route::current()->getName() == 'contact.edit' ? ['contact.edit.do',$contact->kontakid] : 'contact.create.do', 'class' => 'form-horizontal row-fluid'])!!}
                {!! Form::textLabel('nama',$contact->nama,'Nama',['class' => 'span8'])!!}
                {!! Form::textAreaLabel('alamat',$contact->alamat,'Alamat',['rows' => '4' , 'class' => 'span8'])!!}
                {!! Form::textLabel('phone',$contact->phone,'Telepon',['class' =>'span6'])!!}
                {!! Form::textLabel('instansi',$contact->instansi,'Instansi',['class' =>'span6'])!!}
                {!! Form::textLabel('jabatan',$contact->jabatan,'Jabatan',['class' =>'span6'])!!}
                {!! Form::buttonLabel('Proses')!!}
            {!! Form::close()!!}
        </div>
    </div>
@endsection
