<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>M-Bencana.Org</title>
        <link type="text/css" href="{{url('/') . '/template/edmin/code/'}}bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="{{url('/') . '/template/edmin/code/'}}bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="{{url('/') . '/template/edmin/code/'}}css/theme.css" rel="stylesheet">
        <link type="text/css" href="{{url('/') . '/template/edmin/code/'}}images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        @section('styles')

        @show
    </head>
    <body>
        @section('header')
            @include('component.navbar')
        @show
        <div class="wrapper">
            @yield('content')
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; {{date('Y')}} <a href="https://fti.mercubuana-yogya.ac.id/" target="_blank">Fakultas Teknologi Informasi</a> |
                    <a href="https://mercubuana-yogya.ac.id/" target="_blank">Universitas Mercu Buana Yogyakarta </a> </b>.
            </div>
        </div>
        <script src="{{url('/') . '/template/edmin/code/'}}scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="{{url('/') . '/template/edmin/code/'}}scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="{{url('/') . '/template/edmin/code/'}}bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{url('/') . '/template/edmin/code/'}}scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="{{url('/') . '/template/edmin/code/'}}scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="{{url('/') . '/template/edmin/code/'}}scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="{{url('/') . '/js/date-picker/js/'}}bootstrap-datepicker.js" type="text/javascript"></script>
        <script>
            $('document').ready(function(){
                $(".datepicker").datepicker({
                    format : 'dd/mm/yyyy'
                });
                $('.post-to').click(function(){
                    var url = $(this).attr('rel-url');
                    var id = $(this).attr('rel-id');
                    $("#id-csrf").val(id);
                    $("#frm-csrf").attr('action',url).submit();
                });
            });
        </script>
        <form id="frm-csrf" method="POST">
            @csrf
            <input id="id-csrf" type="hidden" value="">
        </form>
        @section('js')

        @show



    </body>
