@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="span3">
                @include('sidebar.admin')
            </div>
            <div class="span9">
                <div class="content">
                    @section('main-content')

                    @show
                </div>
            </div>
        </div>
    </div>
@endsection
