@extends('layouts.master')

@section('main-content')
    <div class="module">
        <div class="module-head">
            <h3>Lokasi</h3>
        </div>
        <div class="module-body">
            @include('includes.messages')
            {!! Form::open(['route' => ['location.create',$disaster->bencanaid],'class' => 'form-horizontal  row-fluid']) !!}
            {!! Form::selectLabel('jenislokasi',array_merge(['' => 'Pilih'],App\Models\LocationType::get()->pluck('jenis_lokasi','id')->toArray()), $location->jenislokasi,'Jenis Lokasi',['class' => 'span8'])!!}
                {!! Form::textLabel('namalokasi',$location->namalokasi,'Nama',['class' => 'span8'])!!}
                {!! Form::textAreaLabel('deskripsi',$location->deskiprsi,'Deskripsi',['rows' => '5','class' => 'span8'])!!}
                {!! Form::selectLabel('propcd',
                array_merge(['' => 'Pilih Provinsi'],App\Models\Province::get()->pluck('provinsi','id')->toArray()),
                $location->propcd,
                'Provinsi',
                ['class' => 'select_prov']) !!}
                {!! Form::selectLabel('kabcd',
                $location->kabcd ? [App\Models\State::where('id',$locatoin->kabcd)->get()->pluck('kabupaten_kota','id')] : ['' => 'Pilih Provinsi Dulu'],
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
                            <input class="span8" type="text">
                        </div>
                        <div class="input-prepend">
                            <span class="add-on">Lon</span>
                            <input class="span8" type="text">
                        </div>
                        <button class="btn" type="button">
                            <i class="icon-map-marker"></i>
                        </button>
                    </div>
                </div>

            {!! Form::close()!!}
        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
    $("document").ready(function(){
        $(".select_prov").change(function(){
            var value = $(this).val();
        });
    });
    </script>
@endsection
