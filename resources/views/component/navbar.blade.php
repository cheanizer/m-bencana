<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href="{{url('')}}">Disaster MS </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                @auth
                <ul class="nav nav-icons">
                    <li>
                        <a href="{{route('dashboard')}}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                </ul>

                <div class="dropdown">
                    @php
                        $disaster = session('disaster');
                    @endphp
                    <form class="navbar-search pull-left input-append" action="#">
                    <a class="dropdown-toggle btn btn-success" data-toggle="dropdown" href="#" id="main-disaster-default">{{ empty ($disaster) ? "Pilih Bencana" : $disaster->bencana}} <i class="icon-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" id="main-disaster-selector">
                        @foreach (App\Models\Disaster::where('status',1)->get() as $key => $disaster )
                        <li><a href="#" class="post-to" rel-url="{{route('disaster.using')}}" rel-id="{{$disaster->bencanaid}}">{{$disaster->bencana}}</a></li>
                        @endforeach
                    </ul>
                    </form>
                </div>
                <ul class="nav pull-right">
                    @if (session('disaster'))
                    @php
                        $disaster = session('disaster');
                    @endphp
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Data
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('location',['id' => $disaster->bencanaid])}}">Lokasi</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrasi
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('disaster')}}">Bencana</a></li>
                            <li><a href="{{route('location.type')}}">Jenis Lokasi</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('user')}}">Pengguna</a></li>
                            <li><a href="#">Pengaturan Aplikasi</a></li>
                        </ul>
                    </li>

                    <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url('/') . '/template/edmin/code/'}}images/user.png" class="nav-avatar" />
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('auth.profile')}}">Kelola Akun</a></li>
                            <li class="divider"></li>
                            <li><a href="#" class="post-to" rel-url="{{route('auth.logout')}}">Logout</a></li>
                        </ul>
                    </li>
                    @endauth
                    @guest
                    <ul class="nav pull-right">
                        <li>
                            <a href="#">Tentang Kami</a>
                        </li>
                    </ul>
                    @endguest
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
