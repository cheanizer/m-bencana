@extends('layouts.master')

@section('main-content')
    <div class="module">
        <div class="module-head">
            <h3>Lokasi</h3>
        </div>
        <div class="module-body">
            @include('includes.messages')
            {!! Form::open(['route' => \Route::current()->getName() == 'location.edit' ?  ['location.edit.do',$disaster->bencanaid,$location->lokasiid] :  ['location.create',$disaster->bencanaid],'class' => 'form-horizontal  row-fluid']) !!}
            {!! Form::selectLabel('jenislokasi',App\Models\LocationType::get()->pluck('jenis_lokasi','id')->toArray(), $location->jenislokasi,'Jenis Lokasi',['class' => 'span8','placeholder' => 'Pilih Jenis Lokasi'])!!}
                {!! Form::textLabel('namalokasi',$location->namalokasi,'Nama',['class' => 'span8'])!!}
                {!! Form::textAreaLabel('deskripsi',$location->deskripsi,'Deskripsi',['rows' => '5','class' => 'span8'])!!}
                {!! Form::selectLabel('propcd',App\Models\Province::get()->pluck('provinsi','id')->toArray(),
                $location->propcd,
                'Provinsi',
                ['class' => 'select_prov','placeholder' => 'Pilih Provinsi']) !!}
                {!! Form::selectLabel('kabcd',
                $location->kabcd ? [App\Models\State::where('provinsi_id',$location->propcd)->get()->pluck('kabupaten_kota','id')] : ['' => 'Pilih Provinsi Dulu'],
                $location->kabcd,
                'Kabupaten/Kota',
                ['class' => 'select_kab']) !!}
                {!! Form::selectLabel('keccd',
                $location->keccd ? [App\Models\District::where('id',$location->keccd)->get()->pluck('kecamatan','id')] : ['' => 'Pilih Kabupaten Dulu'],
                $location->keccd,
                'Kecamatan',
                ['class' => 'select_kec'])!!}

                {!! Form::selectLabel('desacd',
                $location->desacd ? [App\Models\SubDistrict::where('id',$location->desacd)->get()->pluck('kelurahan','id')] : ['' => 'Pilih Kecamatan Dulu'],
                $location->desacd,
                'Kelurahan/Desa',
                ['class' => 'select_kel'])!!}
                <div class="control-group">
                    <label class="control-label">Koordinat</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Lat</span>
                            <input class="span8" type="text" id="latitude" name="latitude" value="{{$location->latitude}}">
                        </div>
                        <div class="input-prepend">
                            <span class="add-on">Lon</span>
                            <input class="span8" type="text" id="longitude" name="longitude" value="{{$location->longitude}}">
                        </div>
                        <button class="btn show-map" type="button">
                            <i class="icon-map-marker"></i>
                        </button>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Kontak</label>
                    <div class="controls">
                        {!! Form::select('kontakid',\App\Models\Contact::get()->pluck('nama','kontakid'),$location->kontaikid,['placeholder' => 'Pilih Kontak'])!!}
                    </div>
                </div>
                {!! Form::buttonLabel('Proses')!!}
            {!! Form::close()!!}
        </div>
    </div>
    <div id="map-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">Select Map</h3>
        </div>
        <div class="modal-body">
            <div id="map" style='width: 500px; height: 300px;'></div>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
          <button class="btn btn-primary">Save changes</button>
        </div>
      </div>
@endsection

@section('styles')
    <style>
        #marker {
        background-image: url('https://docs.mapbox.com/mapbox-gl-js/assets/washington-monument.jpg');
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        }
    </style>

@endsection
@section('styles')
<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('js')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
    <script type="text/javascript">
    $("document").ready(function(){
        $(".select_prov").change(function(){
            var value = $(this).val();
            $.ajax({
                url : '{{route('common.api.state')}}',
                method : 'GET',
                type : 'json',
                data : {
                    provinsi_id : value
                },
                success : function(response){
                    $('.select_kab').empty();
                    $.each(response,function(key,value){
                        $('.select_kab').append('<option value="'+value.id+'">'+value.kabupaten_kota+'</option>')
                    });
                }
            })
        });

        $(".select_kab").change(function(){
            var value = $(this).val();
            $.ajax({
                url : '{{route('common.api.district')}}',
                method : 'GET',
                type : 'json',
                data : {
                    kabkot_id : value
                },
                success : function(response){
                    $(".select_kec").empty();
                    $.each(response, function(key, value){
                        $(".select_kec").append('<option value="'+value.id+'">'+value.kecamatan+'</option');
                    });
                }
            });
        });

        $(".select_kec").change(function(){
            var value = $(this).val();
            $.ajax({
                url  : '{{route('common.api.subdistrict')}}',
                method : 'GET',
                type : 'json',
                data : {
                    kecamatan_id : value
                },
                success : function(response){
                    $(".select_kel").empty();
                    $.each(response,function(key, value){
                        $(".select_kel").append('<option value="'+value.id+'">'+value.kelurahan+'</option');
                    });
                }
            });
        });

        $(".show-map").click(function(){
            $("#map-modal").modal({
                backdrop : false
            }).show();
            return false;
        });
        var map = null;

        $("#map-modal").on('shown',function(){
            mapboxgl.accessToken = 'pk.eyJ1IjoiY2hlYW5pemVyIiwiYSI6ImNqOG9xaWhhcDA2eHcycXJzMWZoMzM0ejUifQ.YIWgUlQXfyo5kOACQeXrjA';
            map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/light-v10',
                center : [ 110.434147,-7.818487],
                zoom : 9
            });
            map.on('click',function(e){
                // var marker = new mapboxgl.Marker()
                // .setLngLat(e.lngLat)
                // .addTo(map);
                $("#latitude").val(e.lngLat.lat);
                $("#longitude").val(e.lngLat.lng);
                $("#map-modal").hide();
            });
        });

    });
    </script>


@endsection
