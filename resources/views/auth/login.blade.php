@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="module module-login span4 offset4">
            {!! Form::open(['route' => 'auth.authenticate','class' => 'form-vertical']) !!}
                <div class="module-head">
                    <h3>Masuk</h3>
                </div>
                <div class="module-body">
                    @if (session('errlogin'))
                                <div class="alert alert-warning">{{session('errlogin')}}</div>
                            @endif
                    <div class="control-group">
                        <div class="controls row-fluid">
                            <input class="span12" name="username" type="text" id="inputEmail" placeholder="Username">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls row-fluid">
                            <input class="span12" name="password" type="password" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="module-foot">
                    <div class="control-group">
                        <div class="controls clearfix">
                            <button type="submit" class="btn btn-primary pull-right">Login</button>
                            <label class="checkbox">
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
