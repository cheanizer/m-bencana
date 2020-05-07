@extends('layouts.master')

@section('main-content')
<div class="module message">
    <div class="module-head">
        <h3>Data Observasi</h3>
    </div>
    <div class="module-option clearfix">
        <div class="pull-right">
            <a href="{{route('observasi.create',['disaster_id' => $disaster->bencanaid])}}" class="btn btn-primary">Buat Observasi</a>
        </div>
    </div>
    <div class="module-body">
        <table class="table table-message table-striped">
            <tbody>
                <tr class="heading">
                    <td class="cell-title">Id</td>
                    <td class="cell-title">Nama</td>
                    <td class="cell-title">Deskripsi</td>
                    <td class="cell-title">Slug</td>
                    <td></td>
                </tr>
                @foreach ($observations as $key => $item)
                    <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->nama}}</td>
                       <td>{{$item->deskripsi}}</td>
                       <td>{{$item->slug}}</td>
                       <td class="clearfix">
                        <a href="{{route('observasi.edit',['disaster_id' => $disaster->bencanaid ,'id' => $item->id])}}" class="pull-right span1">
                            <i class="icon-edit"></i>
                        </a>
                            <a href="#" class="pull-right  post-to" rel-url="{{route('observasi.delete.do',['disaster_id' => $disaster->bencanaid])}}" rel-id="{{$item->id}}">
                                <i class="icon-trash"></i>
                            </a>
                       </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @component('component.pagination',['paginator' => $observations])
    @endcomponent

</div>
@endsection
