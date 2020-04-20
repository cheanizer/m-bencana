@extends('layouts.main')

@section('styles')
<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('js')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiY2hlYW5pemVyIiwiYSI6ImNqOG9xaWhhcDA2eHcycXJzMWZoMzM0ejUifQ.YIWgUlQXfyo5kOACQeXrjA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/cheanizer/ck8vjqmau202s1irleyx3dfg8',
        center : [ 110.434147,-7.818487],
        zoom : 9
    });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Selamat Datang, Username</h2>
            </div>
        </div>
        <div class="row">
            <div class="span6">
                <div class="content">
                    <div class="btn-controls">
                        <div class="btn-box-row row-fluid">
                            <a href="#" class="btn-box big span4"><i class="icon-envelope-alt"></i><b>5399 Item</b>
                                <p class="text-muted">
                                    Demand</p>
                            </a><a href="#" class="btn-box big span4"><i class="icon-list-alt"></i><b>1002 Item</b>
                                <p class="text-muted">
                                    Posisi Stok</p>
                            </a>
                        </div>
                        <div class="btn-box-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <a href="#" class="btn-box small span4"><i class="icon-envelope"></i><b>Messages</b>
                                        </a><a href="#" class="btn-box small span4"><i class="icon-group"></i><b>Clients</b>
                                        </a><a href="#" class="btn-box small span4"><i class="icon-exchange"></i><b>Expenses</b>
                                        </a>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <a href="#" class="btn-box small span4"><i class="icon-save"></i><b>Total Sales</b>
                                        </a><a href="#" class="btn-box small span4"><i class="icon-bullhorn"></i><b>Social Feed</b>
                                        </a><a href="#" class="btn-box small span4"><i class="icon-sort-down"></i><b>Bounce
                                            Rate</b> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div id='map' style='width: 100%; height: 420px;'></div>
            </div>
        </div>
    </div>
@endsection
