@extends('layouts.main')

@section('js')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
<script>
    var URL = "{{url('')}}/";
    mapboxgl.accessToken = 'pk.eyJ1IjoiY2hlYW5pemVyIiwiYSI6ImNqOG9xaWhhcDA2eHcycXJzMWZoMzM0ejUifQ.YIWgUlQXfyo5kOACQeXrjA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/cheanizer/ck8vjqmau202s1irleyx3dfg8',
        center : [ 110.434147,-7.818487],
        zoom : 10
    });
    map.on('click',function(e){
        var marker = new mapboxgl.Marker()
        .setLngLat(e.lngLat)
        .addTo(map);
        //$("#latitude").val(e.lngLat.lat);
        //$("#longitude").val(e.lngLat.lng);
        //$("#map-modal").hide();
    });
    $("document").ready(function(){
        console.log(URL);
        $.ajax({
            url : URL + 'landing/api/location/list',
            method : 'get',
            dataType : 'JSON',
            success : function(response){
                $.each(response,function(key,value){
                    console.log(value);
                    var marker = new mapboxgl.Marker()
        .setLngLat([value.longitude,value.latitude])
        .addTo(map);
                });
            }
        });
    });
    </script>
@endsection

@section('styles')
    <style>
        .row-loc th
        {
            background-color: #29b7d3;
            color: antiquewhite;
        }
        .row-head1 th
        {
            background-color: #cecece;
        }
        .row-head2 td
        {
            background-color: #efefef;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @if ($disaster)
        <div class="span12">
            <div class="content">
                <div class="module">
                    <div class="module-head">
                        <h3>Peta Lokasi Kebencanaan</h3>
                    </div>
                        <div id='map' style='width: 100%; height: 420px;'></div>
                </div>
            </div>
        </div>
        <div class="span12">
            <div class="content">
                <div class="module">
                    <div class="module-head">
                        <h3>Informasi Data Jumlah Dan Lokasi Kebencanaan</h3>
                    </div>
                    <table class="table table-condensed table-bordered">
                        <tr>
                            <th colspan="2" style="text-align: center">Bencana {{$disaster->bencana}}</th>
                        </tr>
                        @foreach ($locations as $kl => $location)
                        <tr class="row-loc">
                            <th>{{$location->namalokasi }}</th>
                            <th>{{$location->type->jenis_lokasi }}</th>
                        </tr>
                        <tr class="row-head1">
                            <th>Observasi</th>
                            <th>Jumlah</th>
                        </tr>
                        @php
                            $cats =  \App\Models\ObserveCategory::orderBy('order','desc')->get();
                        @endphp
                        @foreach ($cats as $cat)
                            <tr class="row-head2">
                                <td  colspan="2">{{$cat->title}}</td>
                            </tr>
                            @php
                                $results = DB::table('observasi')->leftJoin('observasi_lokasi',function($join) use ($location){
                                    $join->on('observasi.id','=','observasi_lokasi.observasi_id');
                                    $join->where('observasi_lokasi.lokasiid','=',$location->lokasiid);
                                })
                                ->join('observasi_kategori','observasi_kategori.id','=','observasi.kategori')
                                ->select('observasi.id','observasi.nama','observasi.deskripsi','observasi_kategori.title','observasi_lokasi.posisi_jumlah')
                                ->whereNull('observasi.deleted_at')
                                ->where('observasi.kategori',$cat->id)
                                ->get();
                            @endphp
                            @foreach ($results as $key => $obs)
                                <tr>
                                    <td>{{$obs->nama}}</td>
                                    <td>{{$obs->posisi_jumlah ? $obs->posisi_jumlah : 0 }}</td>
                                </tr>
                            @endforeach
                        @endforeach


                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

