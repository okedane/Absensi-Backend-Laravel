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
                        <li><a href="" data-key="t-dripicons">Lembur</a></li>
                        <li><a href="" data-key="t-font-awesome">Pelanggaran</a></li>
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
                            <a href="">
                                <i data-feather="calendar"></i>
                                Jadwal
                            </a>
                        </li>
                        <li>
                            <a href="" data-key="t-font-awesome">
                                <i data-feather="check-square"></i>
                                Absensi
                            </a>
                        </li>
                        <li>
                            <a href="" data-key="t-font-awesome">
                                <i data-feather="user-x"></i>
                                Izin
                            </a>
                        </li>
                        <li>
                            <a href="" data-key="t-font-awesome">
                                <i data-feather="user-plus"></i>
                                Lembur
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">MOORA</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('kriteria.index') }}">Kriteria</a></li>
                        <li><a href="{{ route('penilaian.index') }}" data-key="t-material-design">Penilaian</a></li>
                        <li><a href="{{ route('rekap.index') }}" data-key="t-dripicons">Rekap</a></li>
                        <li><a href="{{ route('absensi.index') }}" data-key="t-dripicons">Hasil Moora</a></li>
                    </ul>
                </li> --}}


            </ul>

            {{-- <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="assets/images/giftbox.png" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">Unlimited Access</h5>
                        <p class="font-size-13">Upgrade your plan from a Free trial, to select ‘Business Plan’.</p>
                        <a href="#!" class="btn btn-primary mt-2">Upgrade Now</a>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
