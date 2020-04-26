@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="span3">
                @include('sidebar.admin')
            </div>
            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Buat Pengguna</h3>
                        </div>
                        <div class="module-body">
                            @include('includes.messages')
                            {!! Form::open(['route' => \Route::current()->getName() == 'user.edit' ? ['user.edit.do', $user->id] : 'user.create.do']) !!}
                            <div class="form-horizontal row-fluid">
                                <div class="control-group">
                                    {{Form::label('username','Username',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::text('username',$user->username, ['class' => '']) !!}
                                        @error('username')
                                        <span class="help-inline">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('name','Nama',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::text('name',$user->name, ['class' => '']) !!}
                                        @error('name')
                                        <span class="help-inline">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('email','Email',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::text('email',$user->email, ['class' => '']) !!}
                                        @error('email')
                                        <span class="help-inline">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('role','Role',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::select('role_id',App\Models\Role::all()->pluck('name','id'), $user->role_id) !!}
                                        @error('role')
                                        <span class="help-inline">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('password','Password',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::password('password', ['class' => '']) !!}
                                    </div>
                                </div>
                                <div class="control-group">
                                    {{Form::label('password_confirmation','Konfirmasi Password',['class' => 'control-label'])}}
                                    <div class="controls">
                                        {!! Form::password('password_confirmation', ['class' => '']) !!}
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
