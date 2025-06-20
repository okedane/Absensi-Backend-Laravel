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
                            <h4 class="card-title"></h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#myModal">Create</button>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('jadwal-kerja.index') }}"
                                class="row g-3 mb-4 align-items-end">
                                <div class="col-md-4">
                                    <label for="bulan" class="form-label fw-semibold">Bulan</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="mdi mdi-calendar-month"></i></span>
                                        <input type="month" class="form-control" id="bulan" name="bulan"
                                            value="{{ $bulan }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="mdi mdi-account-tie"></i></span>
                                        <select class="form-select" id="jabatan" name="jabatan">
                                            <option value="">Semua Jabatan</option>
                                            @foreach ($daftarJabatan as $j)
                                                <option value="{{ $j->id }}"
                                                    {{ $jabatan == $j->id ? 'selected' : '' }}>{{ $j->nama_jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="mdi mdi-filter-variant"></i> Filter
                                    </button>
                                </div>
                            </form>

                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:20px">No</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jabatan</th>
                                        <th>Lokasi</th>
                                        <th>Bulan</th>
                                        <th>Total Hari Kerja</th>
                                        <th style="text-align: center; width: 120px;" class="no-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($JadwalKerja as $item)
                                        @php
                                            // Hitung total hari kerja untuk karyawan dalam bulan ini
                                            $totalHariKerja = \App\Models\JadwalKerja::where(
                                                'karyawan_id',
                                                $item->karyawan_id,
                                            )
                                                ->whereMonth('tanggal', substr($item->bulan, 5, 2))
                                                ->whereYear('tanggal', substr($item->bulan, 0, 4))
                                                ->count();
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->karyawan->user->name }}</td>
                                            <td>{{ $item->karyawan->jabatan->nama_jabatan }}</td>
                                            <td>{{ $item->lokasi->nama_lokasi }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->bulan . '-01')->format('F Y') }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $totalHariKerja }} hari</span>
                                            </td>
                                            <td style="text-align: center; width: 120px;">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <!-- Tombol Detail -->
                                                    <a href="{{ route('jadwal-kerja.show', $item->id) }}"
                                                        class="btn btn-soft-info waves-effect waves-light"
                                                        style="padding: 3px 6px;" title="Lihat Detail">
                                                        <i class="mdi mdi-eye font-size-16 align-middle"></i>
                                                    </a>

                                                    <!-- Tombol Edit -->
                                                    <button type="button"
                                                        data-bs-target="#editModal{{ $item->id }}"
                                                        data-bs-toggle="modal"
                                                        class="btn btn-soft-primary waves-effect waves-light"
                                                        style="padding: 3px 6px;" title="Edit">
                                                        <i class="mdi mdi-pencil font-size-16 align-middle"></i>
                                                    </button>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('jadwal-kerja.delete', $item->id) }}"
                                                        method="POST" id="deleteForm{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" style="padding: 3px 6px;"
                                                            class="btn btn-soft-danger waves-effect waves-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $item->id }}"
                                                            title="Hapus">
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
                                                                        Konfirmasi Penghapusan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus Jadwal Kerja untuk
                                                                    <strong>{{ $item->karyawan->user->name }}</strong>
                                                                    bulan
                                                                    <strong>{{ \Carbon\Carbon::parse($item->bulan . '-01')->format('F Y') }}</strong>?
                                                                    <br><br>
                                                                    <small class="text-warning">
                                                                        <i class="mdi mdi-alert-circle"></i>
                                                                        Ini akan menghapus semua jadwal kerja untuk
                                                                        karyawan ini dalam bulan tersebut.
                                                                    </small>
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
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div id="editModal{{ $item->id }}" class="modal fade" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true" data-bs-scroll="true"
                                            data-bs-backdrop="static">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Data Jadwal
                                                            Kerja</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                <select class="form-select karyawan-select"
                                                                    id="karyawan_id_{{ $item->id }}"
                                                                    name="karyawan_id" required>
                                                                    <option value="">Pilih Karyawan</option>
                                                                    @foreach ($karyawans as $k)
                                                                        <option value="{{ $k->id }}"
                                                                            data-jabatan="{{ $k->jabatan_id }}"
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
                                                                    <option value="">Pilih Lokasi</option>
                                                                    @foreach ($lokasi as $l)
                                                                        <option value="{{ $l->id }}"
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
                                                                    id="tanggal_{{ $item->id }}" name="tanggal"
                                                                    value="{{ $item->tanggal }}" required>
                                                                <div class="invalid-feedback">Tanggal harus diisi.
                                                                </div>
                                                            </div>
                                                            <!-- Shift -->
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="shift_{{ $item->id }}">Shift</label>
                                                                <select class="form-select"
                                                                    id="shift_{{ $item->id }}" name="shift"
                                                                    required>
                                                                    <option value="">Pilih Shift</option>
                                                                    <option value="pagi"
                                                                        {{ $item->shift == 'pagi' ? 'selected' : '' }}>
                                                                        Pagi</option>
                                                                    <option value="malam"
                                                                        {{ $item->shift == 'malam' ? 'selected' : '' }}>
                                                                        Malam</option>
                                                                </select>
                                                                <div class="invalid-feedback">Shift harus dipilih.
                                                                </div>
                                                            </div>
                                                            <!-- Jam Masuk -->
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="jam_masuk_{{ $item->id }}">Jam
                                                                    Masuk</label>
                                                                <input type="time" class="form-control"
                                                                    id="jam_masuk_{{ $item->id }}"
                                                                    name="jam_masuk"
                                                                    value="{{ old('jam_masuk', \Carbon\Carbon::parse($item->jam_masuk)->format('H:i')) }}"
                                                                    required>
                                                            </div>
                                                            <!-- Jam Keluar -->
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="jam_keluar_{{ $item->id }}">Jam
                                                                    Keluar</label>
                                                                <input type="time" class="form-control"
                                                                    id="jam_keluar_{{ $item->id }}"
                                                                    name="jam_keluar"
                                                                    value="{{ old('jam_keluar', \Carbon\Carbon::parse($item->jam_keluar)->format('H:i')) }}"
                                                                    required>
                                                                <div class="invalid-feedback">Jam keluar harus diisi.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        data-bs-scroll="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Jadwal Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="{{ route('jadwal-kerja.post') }}" method="POST"
                        novalidate>
                        @csrf
                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label class="form-label" for="jabatan_id_create">Jabatan</label>
                            <select class="form-select jabatan-select" id="jabatan_id_create" name="jabatan_id"
                                data-item="create" required>
                                <option value="">Pilih Jabatan</option>
                                @foreach ($daftarJabatan as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Nama Karyawan -->
                        <div class="mb-3">
                            <label class="form-label" for="karyawan_id_create">Nama Karyawan</label>
                            <select class="form-select karyawan-select" id="karyawan_id_create" name="karyawan_id"
                                required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($karyawans as $k)
                                    <option value="{{ $k->id }}" data-jabatan="{{ $k->jabatan_id }}">
                                        {{ $k->user->name }}</option>
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
                                    <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label" for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            <div class="invalid-feedback">Tanggal harus diisi.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="shift">Shift</label>
                            <select class="form-select" id="shift" name="shift" required>
                                <option value="">Pilih Shift</option>
                                <option value="pagi">Pagi (07:00 - 15:00)</option>
                                <option value="malam">Malam (15:00 - 21:00)</option>
                            </select>
                            <div class="invalid-feedback">Shift harus dipilih.</div>
                        </div>
                        <!-- Jam Masuk -->
                        <div class="mb-3">
                            <label class="form-label" for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" required>
                        </div>
                        <!-- Jam Keluar -->
                        <div class="mb-3">
                            <label class="form-label" for="jam_keluar">Jam Keluar</label>
                            <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" required>
                            <div class="invalid-feedback">Jam keluar harus diisi.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto set jam masuk dan jam keluar berdasarkan shift
        document.getElementById('shift').addEventListener('change', function() {
            const shift = this.value;
            const jamMasuk = document.getElementById('jam_masuk');
            const jamKeluar = document.getElementById('jam_keluar');

            if (shift === 'pagi') {
                jamMasuk.value = '07:00';
                jamKeluar.value = '15:00';
            } else if (shift === 'malam') {
                jamMasuk.value = '15:00';
                jamKeluar.value = '21:00';
            } else {
                // Reset jika tidak memilih shift
                jamMasuk.value = '';
                jamKeluar.value = '';
            }
        });

        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</x-app>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.jabatan-select').forEach(function(jabatanSelect) {
            jabatanSelect.addEventListener('change', function() {
                var itemId = this.getAttribute('data-item');
                var selectedJabatan = this.value;
                var karyawanSelect = document.getElementById('karyawan_id_' + itemId);

                Array.from(karyawanSelect.options).forEach(function(option) {
                    if (option.value === "") {
                        option.style.display = '';
                    } else if (option.getAttribute('data-jabatan') ===
                        selectedJabatan) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Reset karyawan jika jabatan berubah
                karyawanSelect.value = "";
            });
        });
    });
</script>
