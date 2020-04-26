@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="span3">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Pilihan</h3>
                        </div>
                        <ul class="nav nav-list sub-menu">
                            <li class="active"><a href="#">Kelola Akun</a></li>
                            <li><a href="#">Activity Log</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Kelola Akun</h3>
                        </div>
                        <div class="module-body">
                            @include('includes.messages')
                            {!! Form::open(['route' => 'auth.profile.update']) !!}
                            <div class="form-horizontal row-fluid">
                                <div class="control-group">
                                    {{Form::label('username','Username',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::text('username',$user->username, ['class' => '']) !!}
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('name','Nama',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::text('name',$user->name, ['class' => '']) !!}
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('email','Email',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::text('email',$user->email, ['class' => '']) !!}
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('password','Password',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::text('password','', ['class' => '']) !!}
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('password_confirmation','Konfirmasi Password',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::text('password_confirmation','', ['class' => '']) !!}
                                        @error('password')
                                        <span class="help-inline">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        {!! Form::submit('Submit', ['class' => 'btn']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
