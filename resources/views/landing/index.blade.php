@extends('layouts.main')

@section('js')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css' rel='stylesheet' />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script>
    var URL = "{{url('')}}/";

    $("document").ready(function(){
        $(".loading").hide();
        mapboxgl.accessToken = 'pk.eyJ1IjoiY2hlYW5pemVyIiwiYSI6ImNqOG9xaWhhcDA2eHcycXJzMWZoMzM0ejUifQ.YIWgUlQXfyo5kOACQeXrjA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/cheanizer/ck8vjqmau202s1irleyx3dfg8',
            center : [ 110.434147,-7.818487],
            zoom : 10
        });

        console.log(URL);
        $.ajax({
            url : URL + 'landing/api/location/list',
            method : 'get',
            dataType : 'JSON',
            success : function(response){
                $.each(response,function(key,value){
                    var marker = new mapboxgl.Marker()
                    .setLngLat([value.longitude,value.latitude])
                    .addTo(map);
                    marker.getElement().addEventListener('click',function(e){
                        $(".loading").show();
                        $.ajax({
                            url : URL + 'landing/api/location/observasi/' + value.lokasiid,
                            method : 'get',
                            dataType : 'JSON',
                            success : function(res)
                            {
                                console.log(res.length)
                                var html = '<h4>'+value.namalokasi+'</h4>';
                                html += '<table class="table table-bordered"><tr><th>Jenis</th><th>Jumlah</th></tr>';
                                $.each(res,function(k,v){
                                    html += '<tr><td>'+v.nama+'</td><td>'+v.posisi_jumlah+'</td></tr>'
                                    if (k === (res.length - 1))
                                    {
                                        html += "</table>";
                                        $(".loading").hide();
                                        var popup = new mapboxgl.Popup({ offset: 25 })
                                        .setHTML(html);
                                        marker.setPopup(popup).togglePopup();

                                    }
                                });


                            }
                        })
                    });
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

        /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
    </style>
@endsection

@section('content')
<div class="loading">Loading&#8230;</div>
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

