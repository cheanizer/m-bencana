@extends('layouts.administration')

@section('main-content')
<div class="module message">
    <div class="module-head">
        <h3>Bencana</h3>
    </div>
    <div class="module-option clearfix">
        <div class="pull-right">
            <a href="{{route('disaster.create')}}" class="btn btn-primary">Input Bencana</a>
        </div>
    </div>
    <div class="module-body table">
        <table class="table table-message">
            <tbody>
                <tr class="heading">
                    <td class="cell-title">Id</td>
                    <td class="cell-title">Nama</td>
                    <td class="cell-title">Keterangan</td>
                    <td class="cell-title">Status</td>
                    <td class="cell-title">Waktu</td>
                    <td class="cell-title"></td>
                </tr>
                @foreach ($disasters as $key => $item)
                    <tr>
                        <td>{{$item->bencanaid}}</td>
                        <td>{{$item->bencana}}</td>
                        <td class="cell-title">
                            <div>{{$item->deskripsi}}</div>
                        </td>
                        <td>
                            {{$item->status ? 'Aktif' : 'Tidak Aktif'}}
                        </td>
                        <td>
                            {{$item->mulai ? $item->mulai->format('d M Y') : ''}}
                        </td>
                        <td>
                            <a href="{{route('disaster.edit',['id' => $item->bencanaid])}}"><i class="icon-edit"></i> Edit
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
