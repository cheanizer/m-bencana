@extends('layouts.master')

@section('main-content')
    <div class="module">
        <div class="module-head">
            <h3>Input Observasi</h3>
        </div>
        <div class="module-body">
            @include('includes.messages');
            {!! Form::open(['route' => \Route::current()->getName() == 'observasi.create' ? ['observasi.create.do',$disaster->bencanaid] : ['observasi.edit.do',$disaster->bencanaid,$observasi->id],'class' => 'form-horizontal row-fluid'])!!}
                {!! Form::textLabel('nama',$observasi->nama, 'Nama')!!}
                {!! Form::selectLabel('kategori',App\Models\ObserveCategory::all()->pluck('title','id'),$observasi->kategori,'Kategori',['placeholder' => 'Pilih Kategori'])!!}
                {!! Form::textAreaLabel('deskripsi',$observasi->deskripsi,'Deskripsi',['rows' => '3'])!!}
                {!! Form::textLabel('slug',$observasi->nama, 'slug')!!}
                {!! Form::buttonLabel('Proses')!!}
            {!! Form::close()!!}
        </div>
    </div>
@endsection
