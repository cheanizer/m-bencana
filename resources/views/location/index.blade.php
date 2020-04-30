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
        <table class="table table-message">
            <tbody>
                <tr class="heading">
                    <td class="cell-title">Id</td>
                    <td class="cell-title">Nama</td>
                    <td class="cell-title">Deskripsi</td>
                    <td class="cell-title">Kabupaten</td>
                    <td class="cell-title">Kecamatan</td>
                    <td class="cell-title">Kelurahan</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
