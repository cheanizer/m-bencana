@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="span2">
                @include('sidebar.admin')
            </div>
            <div class="span10">
                <div class="content">
                    @section('main-content')

                    @show
                </div>
            </div>
        </div>
    </div>
@endsection
