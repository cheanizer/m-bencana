@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="span3">
            <div class="content">
                <div class="module">
                    <div class="module-head">
                        <h3>Informasi Bencana</h3>
                    </div>
                    <div class="module-body table">
                        <table class="table table-message">
                            <tbody>
                                <tr class="heading">
                                    <td width="40">Id</td><td><span class="label label-info">{{$disaster->bencanaid}}</span></td>
                                </tr>
                                <tr class="heading">
                                    <td width="40">Bencana</td><td>{{$disaster->bencana}}</td>
                                </tr>
                                <tr class="heading">
                                    <td width="40">Dari</td><td>{{! empty($disaster->mulai) ? $disaster->mulai->format('d M Y') : '-'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ul class="nav nav-list sub-menu">
                        <li class="active"><a href="#">Lokasi</a></li>
                        <li><a href="#">Observed</a></li>
                    </ul>
                </div>
            </div>
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
