<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->

    <!-- Role Admin -->
    <!-- Left Sidebar -->
    @role('admin opd')
        <div class="user-info">

            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name ?? '' }}</div>
                <div class="email">{{ Auth::user()->email ?? '' }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('users.profile') }}"><i class="material-icons">account_circle</i>Profile</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('users.settings') }}"><i class="material-icons">settings</i>Pengaturan</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                         document.getElementById('logout-form').submit();"><i
                                    class="material-icons">input</i>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->

        <!-- Menu -->
        <div class="menu">
            <ul class="list">

                <li class="nav-item {{ request()->is('home*') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"> <i class="material-icons">home</i> <span>Dashboard</span> </a>
                </li>
                <li class="header">Blog</li>
                <li class="nav-item {{ request()->is('opd/blog*') ? 'active' : '' }}">
                    <a href="#"> <i class="material-icons">bookmark_border</i> <span>Inovasi
                            Daerah </span> </a>
                </li>
                <li class="header">Inovatif Government Award</li>
                <li class="nav-item {{ request()->is('opd/inovasi-daerah*') ? 'active' : '' }}">
                    <a href="{{ route('opd.list.inovasi') }}"> <i class="material-icons">bookmark_border</i>
                        <span>Inovasi
                            Daerah </span> </a>
                </li>
                <li class="header">Penelitian</li>
                <li class="nav-item {{ request()->is('opd/penelitian-daerah*') ? 'active' : '' }}">
                    <a href="{{ route('opd.list.penelitian') }}"> <i class="material-icons">book</i> <span>Penelitian
                            Daerah</span> </a>
                </li>
                <li class="header">KKN</li>
                <li class="nav-item {{ request()->is('opd/kkn-daerah*') ? 'active' : '' }}">
                    <a href="{{ route('opd.list.kkn') }}"> <i class="material-icons">people</i> <span>KKN </span> </a>
                </li>

            </ul>
        </div>
        <!-- #Menu -->


        <!-- End Role Admin -->

        @elserole('super admin')
        <!-- User Info -->
        <div class="user-info">

            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name ?? '' }}</div>
                <div class="email">{{ Auth::user()->email ?? '' }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('users.profile') }}"><i
                                    class="material-icons">account_circle</i>Profile</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('users.settings') }}"><i class="material-icons">settings</i>Pengaturan</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                         document.getElementById('logout-form').submit();"><i
                                    class="material-icons">input</i>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="nav-item {{ request()->is('home*') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"> <i class="material-icons">home</i> <span>Dashboard</span> </a>
                </li>
                <li class="header">Blog</li>
                <li class="nav-item {{ request()->is('admin/blog*') ? 'active' : '' }}">
                    <a href="{{ url('admin/posts') }}"> <i class="material-icons">post_add</i> <span>Posts </span> </a>
                </li>
                <li class="nav-item {{ request()->is('admin/blog*') ? 'active' : '' }}">
                    <a href="{{ url('admin/categories') }}"> <i class="material-icons">list</i> <span>Categories </span>
                    </a>
                </li>
                <li class="header">Polling / Survey</li>
                <li class="nav-item {{ request()->is('admin/blog*') ? 'active' : '' }}">
                    <a href="{{ url('admin/polling') }}"> <i class="material-icons">insert_chart_outlined</i>
                        <span>Polling </span> </a>
                </li>
                <li class="header">Inovatif Government Award</li>
                <li class="nav-item {{ request()->is('admin/inovasi-daerah*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.inovasi') }}"> <i class="material-icons">bookmark_border</i>
                        <span>Inovasi Daerah </span> </a>
                </li>

                <li class="header">Penelitian</li>
                <li class="nav-item {{ request()->is('admin/penelitian-daerah*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.penelitian') }}"> <i class="material-icons">book</i> <span>Penelitian
                            Daerah </span> </a>
                </li>

                <li class="header">KKN</li>
                <li class="nav-item {{ request()->is('admin/penelitian-daerah*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.kkn') }}"> <i class="material-icons">description</i> <span>KKN</span>
                    </a>
                </li>

                <li class="header">Konfigurasi</li>
                <li class="nav-item {{ request()->is('account*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.account') }}"><i
                            class="material-icons">people</i><span>Account</span></a>
                </li>
                <li class="nav-item {{ request()->is('opd*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.opd') }}"><i class="material-icons">person</i><span>OPD</span></a>
                </li>
                <li class="nav-item {{ request()->is('indikator*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.indikator') }}"><i
                            class="material-icons">insert_drive_file</i><span>Indikator</span></a>
                </li>
                <li class="nav-item {{ request()->is('sumberdana*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.sumberdana') }}"><i class="material-icons">money</i><span>Sumber
                            Dana</span></a>
                </li>
                <li class="header">Question</li>
                <li class="nav-item {{ request()->is('faq*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.faq') }}"><i
                            class="material-icons">question_answer</i><span>F.A.Q</span></a>
                </li>

                <li class="header">Dokumen</li>
                <li class="nav-item {{ request()->is('jenisdokumen*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.jenisdokumen') }}"><i class="material-icons">list</i><span>Jenis
                            Dokumen</span></a>
                </li>
                <li class="nav-item {{ request()->is('dokumen*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.dokumen') }}"><i
                            class="material-icons">book</i><span>Dokumen</span></a>
                </li>

                <li class="header">API Token</li>
                <li class="nav-item {{ request()->is('apitoken*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.apitoken') }}"><i class="material-icons">security</i><span>API
                            Access</span></a>
                </li>

                <li class="header">Pengaduan</li>
                <li class="nav-item {{ request()->is('pengaduan*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.pengaduan') }}"><i class="material-icons">feedback</i><span>Data
                            Pengaduan</span></a>
                </li>

                <li class="header">Lomba</li>
                <li class="nav-item {{ request()->is('jenislomba*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.jenislomba') }}"><i class="material-icons">class</i><span>Jenis
                            Lomba</span></a>
                </li>
                <li class="nav-item {{ request()->is('lomba*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.lomba') }}"><i class="material-icons">class</i><span>Lomba</span></a>
                </li>


            </ul>
        </div>
        <!-- #Menu -->
        <!-- End Role Customer -->

        @elserole('masyarakat')
        <!-- User Info -->
        <div class="user-info">

            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name ?? '' }}</div>
                <div class="email">{{ Auth::user()->email ?? '' }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('users.profile') }}"><i
                                    class="material-icons">account_circle</i>Profile</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('users.settings') }}"><i class="material-icons">settings</i>Pengaturan</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                         document.getElementById('logout-form').submit();"><i
                                    class="material-icons">input</i>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="nav-item {{ request()->is('home*') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"> <i class="material-icons">home</i> <span>Dashboard</span> </a>
                </li>

                <li class="header">Inovatif Government Award</li>
                <li class="nav-item {{ request()->is('admin/inovasi-daerah*') ? 'active' : '' }}">
                    <a href="{{ route('guest.list.inovasi') }}"> <i class="material-icons">bookmark_border</i>
                        <span>Inovasi Daerah </span> </a>
                </li>

                <li class="header">Penelitian</li>
                <li class="nav-item {{ request()->is('admin/penelitian-daerah*') ? 'active' : '' }}">
                    <a href="{{ route('guest.list.penelitian') }}"> <i class="material-icons">book</i> <span>Penelitian
                            Daerah </span> </a>
                </li>

                <li class="header">KKN</li>
                <li class="nav-item {{ request()->is('admin/kkn*') ? 'active' : '' }}">
                    <a href="{{ route('guest.list.kkn') }}"> <i class="material-icons">description</i> <span>KKN</span>
                    </a>
                </li>
                <li class="header">Lomba</li>
                <li class="nav-item {{ request()->is('admin/lomba*') ? 'active' : '' }}">
                    <a href="{{ route('guest.list.lomba') }}"> <i class="material-icons">class</i> <span>Lomba</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/lomba/riwayat*') ? 'active' : '' }}">
                    <a href="{{ route('guest.riwayat.lomba') }}"> <i class="material-icons">class</i> <span>Riwayat
                            Lomba</span> </a>
                </li>

            </ul>
        </div>
        <!-- #Menu -->
        <!-- End Role Customer -->
    @endrole



    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2020 - {{ date('Y') }} <a href="javascript:void(0);"></a>
        </div>
        <div class="version">
            <!-- <b>Version: </b> 1.0.0 -->
            <b>{{ config('app.name', '') }}</b>
        </div>
    </div>
    <!-- #Footer -->
</aside>
