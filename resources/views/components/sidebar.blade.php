<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu </li>

                <li>
                    <a href="/">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">Pendataan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('jabatan.index') }}">Jabatan</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">Absesi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('lokasi-absensi.index') }}">
                                <i data-feather="map-pin"></i>
                                Maps Kantor
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jadwal-kerja.index') }}">
                                <i data-feather="calendar"></i>
                                Jadwal
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('absensi.index') }}" data-key="t-font-awesome">
                                <i data-feather="check-square"></i>
                                Absensi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('izin.index') }}" data-key="t-font-awesome">
                                <i data-feather="user-x"></i>
                                Izin
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lembur.index') }}" data-key="t-font-awesome">
                                <i data-feather="user-plus"></i>
                                Lembur
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">Moora</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('kriteria.index') }}">
                                <i data-feather="sliders"></i>
                                Kriteria
                            </a>
                        </li>
                       
                        <li>
                            <a href="{{ route('penilaian.index') }}">
                                <i data-feather="edit"></i>
                                Penilaian
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i data-feather="bar-chart-2"></i>
                                Hasil
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="">
                        <i data-feather="users"></i>
                        <span data-key="t-dashboard">Management Akun</span>
                    </a>
                </li>
            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
