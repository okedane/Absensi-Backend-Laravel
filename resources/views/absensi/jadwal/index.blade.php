<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Jadwal Kerja</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Jadwal Kerja</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-Items-center">

                            <form method="GET" action="{{ route('jadwal-kerja.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="month" name="bulan" value="{{ $bulan }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <h4 class="card-title"></h4>

                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#myModal">Create</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:20px">No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Bulan</th>
                                    <th>lokasi</th>
                                    <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($JadwalKerja as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->karyawan->user->name }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->lokasi->nama_lokasi }}</td>
                                        <td style="text-align: center; width: 100px;">
                                            <div class="d-flex justify-content-center gap-2">
                                                <!-- Gunakan div container untuk menyusun tombol secara horizontal -->
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button"
                                                        data-bs-target="#editModal{{ $item->id }}"
                                                        data-bs-toggle="modal"
                                                        class="btn btn-soft-primary waves-effect waves-light"
                                                        style="padding: 3px 6px;">
                                                        <i class="mdi mdi-pencil font-size-16 align-middle"></i>
                                                    </button>

                                                    {{-- show jadwal  --}}
                                                    <a href="{{ route('jadwal-kerja.show', $item->id) }}"
                                                        class="btn btn-soft-info waves-effect waves-light"
                                                        style="padding: 3px 6px;">
                                                        <i class="mdi mdi-eye font-size-16 align-middle"></i>
                                                    </a>

                                                    <!-- Form untuk menghapus data -->
                                                    <form action="{{ route('jadwal-kerja.delete', $item->id) }}"
                                                        method="POST" id="deleteForm{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" style="padding: 3px 6px;"
                                                            class="btn btn-soft-danger waves-effect waves-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $item->id }}">
                                                            <i class="mdi mdi-trash-can font-size-16 align-middle"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Modal Konfirmasi Hapus -->
                                                    <div class="modal fade" id="deleteModal{{ $item->id }}"
                                                        tabindex="-1" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">
                                                                        Konfirmasi
                                                                        Penghapusan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus Jadwal Kerja
                                                                    <strong>{{ $item->nama_lokasi }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="document.getElementById('deleteForm{{ $item->id }}').submit();">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card-body">
                                                <div>
                                                    <!-- Edit Modal -->
                                                    <div id="editModal{{ $item->id }}" class="modal fade"
                                                        tabindex="-1" aria-labelledby="editModalLabel"
                                                        aria-hidden="true" data-bs-scroll="true"
                                                        data-bs-backdrop="static">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Edit
                                                                        Data Jadwal Kerja</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form class="needs-validation"
                                                                    action="{{ route('jadwal-kerja.put', $item->id) }}"
                                                                    method="POST" novalidate>
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <!-- Nama Karyawan -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="karyawan_id_{{ $item->id }}">Nama
                                                                                Karyawan</label>
                                                                            <select class="form-select"
                                                                                id="karyawan_id_{{ $item->id }}"
                                                                                name="karyawan_id" required>
                                                                                <option value="">Pilih Karyawan
                                                                                </option>
                                                                                @foreach ($karyawans as $k)
                                                                                    <option
                                                                                        value="{{ $k->id }}"
                                                                                        {{ $item->karyawan_id == $k->id ? 'selected' : '' }}>
                                                                                        {{ $k->user->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <!-- Nama Lokasi -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="lokasi_id_{{ $item->id }}">Nama
                                                                                Lokasi</label>
                                                                            <select class="form-select"
                                                                                id="lokasi_id_{{ $item->id }}"
                                                                                name="lokasi_id" required>
                                                                                <option value="">Pilih Lokasi
                                                                                </option>
                                                                                @foreach ($lokasi as $l)
                                                                                    <option
                                                                                        value="{{ $l->id }}"
                                                                                        {{ $item->lokasi_id == $l->id ? 'selected' : '' }}>
                                                                                        {{ $l->nama_lokasi }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <!-- Tanggal -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="tanggal_{{ $item->id }}">Tanggal</label>
                                                                            <input type="date" class="form-control"
                                                                                id="tanggal_{{ $item->id }}"
                                                                                name="tanggal"
                                                                                value="{{ $item->tanggal }}" required>
                                                                            <div class="invalid-feedback">Tanggal harus
                                                                                diisi.</div>
                                                                        </div>
                                                                        {{-- Shift --}}
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="shift_{{ $item->id }}">Shift</label>
                                                                            <select class="form-select"
                                                                                id="shift_{{ $item->id }}"
                                                                                name="shift" required>
                                                                                <option value="">Pilih Shift
                                                                                </option>
                                                                                <option value="pagi"
                                                                                    {{ $item->shift == 'pagi' ? 'selected' : '' }}>
                                                                                    Pagi</option>
                                                                                <option value="malam"
                                                                                    {{ $item->shift == 'malam' ? 'selected' : '' }}>
                                                                                    Malam</option>
                                                                            </select>
                                                                            <div class="invalid-feedback">Shift harus
                                                                                dipilih.</div>
                                                                        </div>
                                                                        <!-- jam_masuk -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="jam_masuk{{ $item->id }}">Jam
                                                                                Masuk</label>
                                                                            <input type="time" class="form-control"
                                                                                id="jam_masuk_{{ $item->id }}"
                                                                                name="jam_masuk"
                                                                                value="{{ old('jam_masuk', \Carbon\Carbon::parse($item->jam_masuk)->format('H:i')) }}"
                                                                                required>
                                                                        </div>
                                                                        <!-- jam_keluar -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="jam_keluar_{{ $item->id }}">Jam
                                                                                Keluar</label>
                                                                            <input type="time" class="form-control"
                                                                                id="jam_keluar_{{ $item->id }}"
                                                                                name="jam_keluar"
                                                                                value="{{ old('jam_keluar', \Carbon\Carbon::parse($item->jam_keluar)->format('H:i')) }}"
                                                                                required>
                                                                            <div class="invalid-feedback">Jam keluar
                                                                                harus diisi.</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan
                                                                            Perubahan</button>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal -->
                                                </div> <!-- end preview-->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end cardaa -->
            </div> <!-- end col -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card-body">
                <div>
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true" data-bs-scroll="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Tambah Jadwal Kerja</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="{{ route('jadwal-kerja.post') }}"
                                        method="POST" novalidate>
                                        @csrf
                                        <!-- Nama Karyawan -->
                                        <div class="mb-3">
                                            <label class="form-label" for="karyawan_id">Nama Karyawan</label>
                                            <select class="form-select" id="karyawan_id" name="karyawan_id" required>
                                                <option value="">Pilih Karyawan</option>
                                                @foreach ($karyawans as $k)
                                                    <option value="{{ $k->id }}">{{ $k->user->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Nama karyawan harus dipilih.</div>
                                        </div>
                                        <!-- Nama Lokasi -->
                                        <div class="mb-3">
                                            <label class="form-label" for="lokasi_id">Nama Lokasi</label>
                                            <select class="form-select" id="lokasi_id" name="lokasi_id" required>
                                                <option value="">Pilih Lokasi</option>
                                                @foreach ($lokasi as $l)
                                                    <option value="{{ $l->id }}">{{ $l->nama_lokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Tanggal -->
                                        <div class="mb-3">
                                            <label class="form-label
                                                "
                                                for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                required>
                                            <div class="invalid-feedback">Tanggal harus diisi.</div>
                                        </div>
                                        {{-- Shift --}}
                                        <div class="mb-3">
                                            <label class="form-label
                                                "
                                                for="shift">Shift</label>
                                            <select class="form-select" id="shift" name="shift" required>
                                                <option value="">Pilih Shift</option>
                                                <option value="pagi">Pagi</option>
                                                <option value="malam">Malam</option>
                                            </select>
                                            <div class="invalid-feedback">Shift harus dipilih.</div>
                                        </div>

                                        <!-- jam_masuk -->
                                        <div class="mb-3">
                                            <label class="form-label
                                                "
                                                for="jam_masuk">Jam Masuk</label>
                                            <input type="time" class="form-control" id="jam_masuk"
                                                name="jam_masuk" required>
                                        </div>
                                        <!-- jam_pulang -->
                                        <div class="mb-3">
                                            <label class="form-label
                                                "
                                                for="jam_keluar">Jam Keluar</label>
                                            <input type="time" class="form-control" id="jam_keluar"
                                                name="jam_keluar" required>
                                            <div class="invalid-feedback">Jam keluar harus diisi.</div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end preview-->

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>

</x-app>
