@extends('layouts.main')

@section('styles')
    <style>
        .table-message tbody tr.selected td
        {
            background-color: #a1eaf8;
        }

        .table-popup tr th
        {
            background-color: #a1eaf8;
        }

        .form-modal .controls
        {
            margin-left: 100px;
        }

        .form-modal .control-label
        {
            width: 100px;
            margin-right: 10px;
        }
        .loading-icon{background:url(images/spinner.gif) center no-repeat #fff;display:inline-block;font-size:0;height:100%;position:fixed;top:0;left:0;width:100%;z-index:9999999999999999999!important;opacity:.5}
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('js/angular/ui-bootsrap.css')}}">

@endsection

@section('content')
    <div class="container" ng-app="app">

            <http-request-loader>
                <h1>Loading</h1>
            </http-request-loader>

        <div class="row">
            <div class="span12">
                <div class="module" ng-controller="stockAppController">
                    <div class="module-head">
                        <state-loader></state-loader>
                        <h3>Pencatatan Bencana {{$disaster->bencana}}</h3>
                    </div>
                    <div class="module-body" style="margin:5px 5px;padding:0px">
                        <div class="row">
                            <div class="span4">
                                <div class="module message">
                                    <div class="module-head" style="background-color: #29b7d3">
                                        <h3 style="color:#ffffff">Lokasi</h3>
                                    </div>
                                    <div class="module-option clearfix" style="padding:1px 0px 0px 0px;margin:0px">
                                        <form class="form-search" ng-submit="getLocation()">
                                            <input type="text" name="search" ng-model="filter.search" class="search-query" style="margin-bottom: 0px" placeholder="Cari Lokasi">
                                            <button type="button" class="btn btn-default" ng-click="getLocation()">Cari</button>
                                        </form>
                                    </div>
                                    <div class="module-body table">
                                        <table class="table table-message table-hovered table-bordered table-striped">
                                            <tbody>
                                                <tr class="heading">
                                                    <td class="cell-title">Lokasi</td>
                                                    <td class="cell-title">Jenis</td>
                                                </tr>
                                                <tr ng-repeat="(key, lokasi) in locations" ng-click="selectLocation(lokasi.lokasiid)" ng-class="{'selected' : location.lokasiid == lokasi.lokasiid}">
                                                    <td>@{{lokasi.namalokasi}}</td>
                                                    <td>@{{lokasi.type.jenis_lokasi}}</td>
                                                </tr>
                                                <tr ng-if="!locations || locations.length < 1">
                                                    <td colspan="2">Lokasi Kosong</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="span8" style="margin-left:10px">
                                <div class="module message" style="border-top: none;border-right: none;border-bottom: none;">
                                    <div class="module-head" style="background-color: #29b7d3">
                                        <h3 style="color:#ffffff">Detail Lokasi</h3>
                                    </div>
                                    <div class="module-body table">
                                        <div style="padding:5px" ng-if="location">
                                            <h4>@{{location.namalokasi}}</h4>
                                            <address>
                                                <small>
                                                @{{location.alamat}}<br>
                                                @{{location.subdistrict.kelurahan}},@{{location.district.kecamatan}}, <br>
                                                @{{location.state.kabupaten_kota}},@{{location.province.provinsi}} <br>
                                                <span ng-if="location.contact">Kontak : @{{location.contact.nama}} (@{{location.contact.phone}})</span>
                                                </small>
                                            </address>
                                        </div>
                                        <table class="table table-message table-condensed table-hovered table-bordered table-striped" ng-if="location">
                                            <tbody>
                                                <tr class="heading">
                                                    <td class="cell-title">Nama</td>
                                                    <td class="cell-title">Kategori</td>
                                                    <td class="cell-title">Jumlah</td>
                                                    <td></td>
                                                </tr>
                                                <tr ng-repeat="(key, observasi) in observations">
                                                    <td>@{{observasi.nama}}</td>
                                                    <td>@{{observasi.title}}</td>
                                                    <td>@{{observasi.posisi_jumlah}}</td>
                                                    <td align="right" style="text-align: right">
                                                        <button class="btn btn-default btn-xs" ng-click="showModal(observasi,location)">Buat Transaksi</button>
                                                        <button class="btn btn-default btn-xs" ng-click="">History Transaksi</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="alert alert-info" ng-if="!location">
                                            Silahkan pilih lokasi
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    <script type="text/ng-template" id="myModalContent.html">

        <div class="modal-header">
            <button type="button" class="close" ng-click="exit()">×</button>
            <h3 id="myModalLabel" style="text-align:center">Transaksi </h3>
        </div>
        <table class="table table-condensed table-popup table-bordered">
            <tr>
                <th>Lokasi</th>
                <th>Title</th>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>@{{location.namalokasi}}</td>
                <td>@{{observasi.nama}}</td>
                <td>@{{observasi.title}}</td>
                <td>@{{observasi.posisi_jumlah ?  observasi.posisi_jumlah : 0}}</td>
            </tr>
        </table>
        <form ng-submit="kirim()" class="form-horizontal form-modal">
        <div class="modal-body">

                <div class="control-group">
                    <label class="control-label">Type</label>
                    <div class="controls">
                        <label class="radio inline">
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="true" ng-click="changeValue('penjumlahan')">
                            Penambahan
                        </label>
                        <label class="radio inline">
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" ng-click="changeValue('pengurangan')">
                            Pengurangan
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Oleh</label>
                    <div class="controls">
                        <input type="text" disabled="disabled" value="Adhi Setyawan" class="span4"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Jumlah</label>
                    <div class="controls">
                        <input type="number" ng-model="form.jumlah" class="span4" ng-keyup="hitung()"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Sumber/Tujuan</label>
                    <div class="controls">
                        <input type="text" ng-model="form.sumber_tujuan" class="span4"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Keterangan</label>
                    <div class="controls">
                        <textarea rows="4" ng-model="form.keterangan" class="span4"></textarea>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button class="btn" ng-click="exit()">Close</button>
            <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </form>
    </script>
    </div>

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
<script src="{{asset('js/angular/ui-bootsrap-tpls.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/nikhilrane1992/angular-http-request-loader/00c488f1/dist/angular-http-request-loader.min.js"></script>

<script>
    var URL = '{!! url('') !!}/';
    var BENCANAID = '{!! $disaster->bencanaid !!}';
</script>
<script src="{{asset('js/site/stock.js')}}" type="text/javascript"></script>
@endsection
