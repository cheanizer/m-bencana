@extends('layouts.administration')

@section('main-content')
    <div class="module message">
        <div class="module-head">
            <h3>Jenis Lokasi</h3>
        </div>
        <div class="module-option clearfix">
            <div class="pull-right">
                <a href="{{route('location.type.create')}}" class="btn btn-success">Input Type Lokasi</a>
            </div>
        </div>
        <div class="module-body table">
            <table class="table table-message table-striped">
                <tbody>
                    <tr class="heading">
                        <td class="cell-title">#id</td>
                        <td class="cell-title">Jenis</td>
                        <td></td>
                    </tr>
                    @foreach ($datas as $key => $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->jenis_lokasi}}</td>
                            <td class="clearfix" width="200">
                                <a href="{{route('location.type.edit',['id' => $value->id])}}" class="pull-right span1">
                                    <i class="icon-edit"></i>
                                </a>

                                <a href="#" class="pull-right  post-to" rel-url="{{route('location.type.delete.do')}}" rel-id={{$value->id}}>
                                    <i class="icon-trash"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
