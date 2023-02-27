    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-white border-bottom shadow-sm">
        <div class="container px-0">
            <div class="d-flex">
                <img src="{{ asset('admin-bsb/images/Lambang-Kabupaten-Cirebon-Jawa-Barat.png') }}" alt="logokabcrb"
                    width="50">
                <a style="font-size: 14px; text-decoration: none; color: #000 !important"
                    class="d-none d-md-block align-self-center pl-2">
                    <b>Sistem Informasi Pengembangan &
                        Penelitian</b>
                    <br>
                    <span class="text-muted">Kabupaten Cirebon<span>
                </a>
            </div>
            <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <ul class="navbar-nav ml-auto text-body ">
                    <li class="nav-item {{ request()->is('/') ? 'active' : false }}">
                        <a class="nav-link mr-3" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item {{ request()->is('news*') ? 'active' : false }}">
                        <a class="nav-link mr-3" href="{{ url('news') }}">Blog</a>
                    </li>
                    <li class="nav-item {{ request()->is('dokumen*') ? 'active' : false }}">
                        <a class="nav-link mr-3" href="{{ url('dokumen') }}">Dokumen</a>
                    </li>
                    <li class="nav-item {{ request()->is('faq*') ? 'active' : false }}">
                        <a class="nav-link mr-3" href="{{ url('faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item dropdown mr-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Informasi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('pengaduan') }}">Pengaduan</a>
                            <a class="dropdown-item" href="{{ url('lomba') }}">Lomba</a>
                            <a class="dropdown-item" href="{{ url('penelitian') }}">Penelitian</a>
                            <a class="dropdown-item" href="{{ url('pollings') }}">Survei</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning" href="{{ route('login') }}">
                            <span class="px-3 py-2 text-white font-weight-bold">Login</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
