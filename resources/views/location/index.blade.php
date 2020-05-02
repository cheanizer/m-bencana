@extends('layouts.master')

@section('main-content')
<div class="module message">
    <div class="module-head">
        <h3>Kelola Lokasi</h3>
    </div>
    <div class="module-option clearfix">
        <div class="pull-right">
            <a href="{{route('location.create',['id' => $disaster->bencanaid])}}" class="btn btn-primary">Buat Lokasi</a>
        </div>
    </div>
    <div class="module-body">
        <table class="table table-message table-striped">
            <tbody>
                <tr class="heading">
                    <td class="cell-title">Id</td>
                    <td class="cell-title">Nama</td>
                    <td class="cell-title">Deskripsi</td>
                    <td class="cell-title">
                        Alamat
                    </td>
                    <td></td>
                </tr>
                @foreach ($locations as $key => $location)
                    <tr>
                        <td>{{$location->lokasiid}}</td>
                        <td>{{$location->namalokasi}}</td>
                        <td>{{$location->deskripsi}}</td>
                        <td>{{$location->subdistrict->kelurahan}}, {{$location->district->kecamatan}}, {{$location->state->kabupaten_kota}}</td>
                        <td class="clearfix" width="200">
                            <a href="{{route('location.edit',['disaster_id' => $disaster->bencanaid ,'id' => $location->lokasiid])}}" class="pull-right span1">
                                <i class="icon-edit"></i>
                            </a>
                            <a href="#" class="pull-right  post-to" rel-url="{{route('location.delete.do',['id' => $location->lokasiid])}}" rel-id="{{$location->locationid}}">
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
