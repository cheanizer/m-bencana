@extends('layouts.main')

@section('js')
    <script>
        $("document").ready(function(){
            var d1 = [ [0, 1], [1, 14], [2, 5], [3, 4], [4, 5], [5, 1], [6, 14], [7, 5],  [8, 5] ];
		    var d2 = [ [0, 5], [1, 2], [2, 10], [3, 1], [4, 9],  [5, 5], [6, 2], [7, 10], [8, 8] ];
            var plot = $.plot($("#placeholder2"),
			   [ { data: d1, label: "Data Y"}, { data: d2, label: "Data X" } ], {
					lines: {
						show: true,
						fill: true, /*SWITCHED*/
						lineWidth: 2
					},
					points: {
						show: true,
						lineWidth: 5
					},
					grid: {
						clickable: true,
						hoverable: true,
						autoHighlight: true,
						mouseActiveRadius: 10,
						aboveData: true,
						backgroundColor: "#fafafa",
						borderWidth: 0,
						minBorderMargin: 25,
					},
					colors: [ "#090", "#099",  "#609", "#900"],
					shadowSize: 0
				 });
        });
    </script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="span9">
            <div class="content">
                <div class="module">
                    <div class="module-head">
                        <h3>Grafik Permintaan dan Ketersediaan Barang</h3>
                    </div>
                    <div class="module-body">
                        <div class="chart inline-legend grid">
                            <div id="placeholder2" class="graph" style="height: 500px"></div>
                        </div>
                    </div>
                </div>
                <div class="module hide">
                    <div class="module-head">
                        <h3>
                            Adjust Budget Range</h3>
                    </div>
                    <div class="module-body">
                        <div class="form-inline clearfix">
                            <a href="#" class="btn pull-right">Update</a>
                            <label for="amount">
                                Price range:</label>
                            &nbsp;
                            <input type="text" id="amount" class="input-" />
                        </div>
                        <hr />
                        <div class="slider-range">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span3">
            <div class="content">
                <div class="module">
                    @auth
                    <div class="module-head">
                        <h3>Menu</h3>
                    </div>
                    <div class="module-body">
                        Selamat datang
                        <br />
                        {{Auth::user()->name}} <a href="#">[logout]</a>
                    </div>
                    @endauth
                    @guest
                        <form class="form-vertical" action="{{route('auth.authenticate')}}" method="POST">
                            @csrf
                            <div class="module-head">
                                <h3>Masuk</h3>
                            </div>
                            <div class="module-body">
                                @if (session('errlogin'))
                                <div class="alert alert-warning">{{session('errlogin')}}</div>
                            @endif
                                <div class="control-group">
                                    <div class="controls row-fluid">
                                        <input class="span12" type="text" name="username" id="inpUsername" placeholder="Username">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls row-fluid">
                                        <input class="span12" type="password" name="password" id="inputPassword" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="module-foot">
                                <div class="control-group">
                                    <div class="controls clearfix">
                                        <button type="submit" class="btn btn-primary pull-right">Login</button>
                                        <label class="checkbox">
                                            <input type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

