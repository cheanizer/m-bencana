<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href="{{url('')}}">Disaster MS </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                @auth
                <ul class="nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Faskes
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Daftar Faskes</a></li>
                            <li><a href="#">Cakupan Faskes</a></li>
                            <li><a href="#">Kebutuhan Logistik</a></li>
                            <li><a href="#">Distribusi Logistik</a></li>
                            <li class="divider"></li>
                            <li class="nav-header">Example Header</li>
                            <li><a href="#">A Separated link</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrasi
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Produk</a></li>
                            <li><a href="#">Pengungsian</a></li>
                            <li><a href="#">Jenis Bantuan</a></li>
                            <li><a href="#">Lokasi Pengungsian</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Pengguna</a></li>
                            <li><a href="#">Pengaturan Aplikasi</a></li>
                        </ul>
                    </li>

                    <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url('/') . '/template/edmin/code/'}}images/user.png" class="nav-avatar" />
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Your Profile</a></li>
                            <li><a href="#">Edit Profile</a></li>
                            <li><a href="#">Account Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Logout</a></li>
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
