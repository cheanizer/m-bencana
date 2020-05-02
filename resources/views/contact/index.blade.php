@extends('layouts.administration')

@section('main-content')
<div class="module message">
    <div class="module-head">
        <h3>Kontak</h3>
    </div>
    <div class="module-option clearfix">
        <div class="pull-right">
            <a href="{{route('contact.create')}}" class="btn btn-primary">Buat Kontak</a>
        </div>
    </div>
    <div class="module-body table">
        <table class="table table-message">
            <tbody>
                <tr class="heading">
                    <td class="cell-title">Id</td>
                    <td class="cell-title">Nama</td>
                    <td class="cell-title">Alamat</td>
                    <td class="cell-title">Telepon</td>
                    <td class="cell-title">Instansi</td>
                    <td class="cell-title">Jabatan</td>
                    <td></td>
                </tr>
                @foreach ($contacts as $key => $item)
                <tr class="">
                    <td class="cell-title">{{$item->kontakid}}</td>
                    <td class="cell-title">{{$item->nama}}</td>
                    <td class="cell-title">{{$item->alamat}}</td>
                    <td class="cell-title">{{$item->phone}}</td>
                    <td class="cell-title">{{$item->instansi}}</td>
                    <td class="cell-title">{{$item->jabatan}}</td>
                    <td class="clearfix" width="200">
                        <a href="{{route('contact.edit',['id' => $item->kontakid])}}" class="pull-right span1">
                            <i class="icon-edit"></i>
                        </a>
                        <a href="#" class="pull-right  post-to" rel-url="{{route('contact.delete.do',['id' => $item->kontakid])}}" rel-id="{{$item->kontakid}}">
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
