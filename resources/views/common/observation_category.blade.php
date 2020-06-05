@extends('layouts.administration')

@section('main-content')
<div class="module message">
    <div class="module-head">
        <h3>Kategori Observasi</h3>
    </div>
    <div class="module-body table">
        <table class="table table-message table-striped">
            <tbody>
                <tr class="heading">
                    <td class="cell-title">#id</td>
                    <td class="cell-title">Nama</td>
                    <td class="cell-title">Keterangan</td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach ($categories as $key => $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->title}}</td>
                        <td>{{$value->deskripsi}}</td>
                        <td class="clearfix">
                            <a style="width: 20px" href="{{route('observasi.kategori.edit',['id' => $value->id])}}" class=" span1">
                                <i class="icon-edit"></i>
                            </a>
                        </td>
                        <td class="clearfix">
                            <a style="width: 20px" href="{{route('observasi.kategori.up',['id' => $value->id])}}" class=" span1">
                                <i class="icon-arrow-up"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
