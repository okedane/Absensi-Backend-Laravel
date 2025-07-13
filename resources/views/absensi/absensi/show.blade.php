<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Detail Absensi - {{ $karyawan->user->name ?? 'Karyawan' }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('absensi.index') }}">Absensi</a></li>
                                <li class="breadcrumb-item active">Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Karyawan -->
            @if ($karyawan)
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Nomor Karyawan:</strong><br>
                                        {{ $karyawan->nomor_karyawan }}
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Nama:</strong><br>
                                        {{ $karyawan->user->name }}
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Jabatan:</strong><br>
                                        {{ $karyawan->jabatan->nama_jabatan }}
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Total Absensi:</strong><br>
                                        <span
                                            class="badge badge-soft-primary font-size-12">{{ $absensis->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tombol Kembali -->
            <div class="row mb-3">
                <div class="col-12">
                    <a href="{{ route('absensi.index') }}?{{ http_build_query(request()->only(['jabatan', 'bulan'])) }}"
                        class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Riwayat Absensi Detail</h5>
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:20px">No</th>
                                        <th>Tanggal</th>
                                        <th>Shift</th>
                                        <th>Jam Absen</th>
                                        <th>Status</th>
                                        <th>Keterlambatan</th>
                                        <th>Jadwal Kerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($absensis as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $item->shift == 'pagi' ? 'badge bg-primary' : 'badge bg-secondary' }}">
                                                    {{ ucfirst($item->shift) }}
                                                </span>
                                            </td>
                                            <td>{{ $item->jam_absen ? \Carbon\Carbon::parse($item->jam_absen)->format('H:i') : '-' }}
                                            </td>
                                            <td>
                                                @if ($item->status == 'tepat waktu')
                                                    <span class="badge bg-success">Tepat Waktu</span>
                                                @elseif($item->status == 'terlambat')
                                                    <span class="badge bg-warning">Terlambat</span>
                                                @else
                                                    <span class="badge bg-info">Izin</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->keterlambatan)
                                                    <span class="text-danger">{{ $item->keterlambatan }} menit</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->jadwalKerja)
                                                    {{ $item->jadwalKerja->jam_masuk }} -
                                                    {{ $item->jadwalKerja->jam_keluar }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                           
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data absensi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
