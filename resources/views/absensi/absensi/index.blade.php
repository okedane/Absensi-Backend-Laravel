<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Absensi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Absensi</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('absensi.index') }}" class="row g-3">
                                <div class="col-md-4">
                                    <label for="jabatan" class="form-label">Filter Jabatan</label>
                                    <select name="jabatan" id="jabatan" class="form-select">
                                        <option value="">Semua Jabatan</option>
                                        @foreach($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}" 
                                                {{ $sortJabatan == $jabatan->id ? 'selected' : '' }}>
                                                {{ $jabatan->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="bulan" class="form-label">Filter Bulan</label>
                                    <select name="bulan" id="bulan" class="form-select">
                                        <option value="">Semua Bulan</option>
                                        @foreach($bulans as $key => $bulan)
                                            <option value="{{ $key }}" 
                                                {{ $sortBulan == $key ? 'selected' : '' }}>
                                                {{ $bulan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                                    <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:20px">No</th>
                                        <th>NK</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Total Absensi</th>
                                        <th>Tepat Waktu</th>
                                        <th>Terlambat</th>
                                        <th>Izin</th>
                                        <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($absensis as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomor_karyawan }}</td>
                                            <td>{{ $item->nama_karyawan }}</td>
                                            <td>{{ $item->nama_jabatan }}</td>
                                            <td>
                                                <span class="badge badge-soft-primary">{{ $item->total_absensi }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-success">{{ $item->tepat_waktu }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-warning">{{ $item->terlambat }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-info">{{ $item->izin }}</span>
                                            </td>
                                            <td style="text-align: center; width: 100px;">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('absensi.show', $item->karyawan_id) }}?{{ http_build_query(request()->only(['jabatan', 'bulan'])) }}"
                                                        class="btn btn-soft-info waves-effect waves-light"
                                                        style="padding: 3px 6px;" title="Lihat Detail Absensi">
                                                         <i class="mdi mdi-eye font-size-16 align-middle"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data absensi</td>
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