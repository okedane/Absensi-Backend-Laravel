<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Lembur</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Lembur</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter Data Lembur</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lembur.index') }}" method="GET" class="row g-3">
                                <div class="col-md-4">
                                    <label for="bulan" class="form-label">Periode Bulan</label>
                                    <input type="month" class="form-control" id="bulan" name="bulan" value="{{ $monthInput ?? date('Y-m') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="id_jabatan" class="form-label">Jabatan</label>
                                    <select class="form-select" id="id_jabatan" name="id_jabatan">
                                        <option value="">Semua Jabatan</option>
                                        @foreach ($jabatan as $j)
                                            <option value="{{ $j->id }}" {{ $jabatanId == $j->id ? 'selected' : '' }}>
                                                {{ $j->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">Terapkan Filter</button>
                                    <a href="{{ route('lembur.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-Items-center">
                            <div>
                                <h4 class="card-title mb-0">Data Lembur</h4>
                                <p class="text-muted mb-0">
                                    <span class="badge bg-info">Total: {{ count($lemburs) }} data</span>
                                    @if($jabatanId)
                                        <span class="badge bg-primary">Jabatan: {{ $jabatan->where('id', $jabatanId)->first()->nama_jabatan }}</span>
                                    @endif
                                    <span class="badge bg-success">Periode: {{ isset($monthInput) ? \Carbon\Carbon::parse($monthInput)->format('F Y') : 'Semua Waktu' }}</span>
                                </p>
                            </div>
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#myModal">Tambah Data</button>
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Total Jam</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lemburs as $index => $lembur)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $lembur->karyawan->user->name ?? '-' }}</td>
                                        <td>{{ $lembur->karyawan->jabatan->nama_jabatan ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($lembur->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ $lembur->jam_mulai }}</td>
                                        <td>{{ $lembur->jam_selesai }}</td>
                                        <td>{{ $lembur->total_jam }}</td>
                                        <td style="text-align: center; width: 100px;">
                                            <div class="d-flex justify-content-center gap-2">
                                                <!-- Gunakan div container untuk menyusun tombol secara horizontal -->
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button"
                                                        data-bs-target="#editModal{{ $lembur->id }}"
                                                        data-bs-toggle="modal"
                                                        class="btn btn-soft-primary waves-effect waves-light"
                                                        style="padding: 3px 6px;">
                                                        <i class="mdi mdi-pencil font-size-16 align-middle"></i>
                                                    </button>

                                                    <form action="{{ route('lembur.delete', $lembur->id) }}"
                                                        method="POST" id="deleteForm{{ $lembur->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" style="padding: 3px 6px;"
                                                            class="btn btn-soft-danger waves-effect waves-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $lembur->id }}">
                                                            <i class="mdi mdi-trash-can font-size-16 align-middle"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Modal Konfirmasi Hapus -->
                                                    <div class="modal fade" id="deleteModal{{ $lembur->id }}"
                                                        tabindex="-1" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">
                                                                        Konfirmasi Penghapusan
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data lembur
                                                                    <strong>{{ $lembur->karyawan->nama_karyawan ?? 'Karyawan' }}</strong>
                                                                    pada tanggal
                                                                    <strong>{{ \Carbon\Carbon::parse($lembur->tanggal)->format('d-m-Y') }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="document.getElementById('deleteForm{{ $lembur->id }}').submit();">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div id="editModal{{ $lembur->id }}" class="modal fade" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true" data-bs-scroll="true"
                                        data-bs-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Data Lembur</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form class="needs-validation"
                                                    action="{{ route('lembur.update', $lembur->id) }}" method="POST"
                                                    novalidate>
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <!-- Tambahkan dropdown Jabatan -->
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="edit_jabatan_id{{ $lembur->id }}">Jabatan</label>
                                                            <select class="form-control edit-jabatan-dropdown"
                                                                id="edit_jabatan_id{{ $lembur->id }}"
                                                                name="jabatan_id" required
                                                                data-lembur-id="{{ $lembur->id }}">
                                                                <option value="">Pilih Jabatan</option>
                                                                @foreach ($jabatan as $j)
                                                                    <option value="{{ $j->id }}"
                                                                        {{ $lembur->karyawan->id_jabatan == $j->id ? 'selected' : '' }}>
                                                                        {{ $j->nama_jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Jabatan harus dipilih
                                                            </div>
                                                        </div>

                                                        <!-- Modifikasi dropdown Karyawan -->
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="edit_karyawan_id{{ $lembur->id }}">Karyawan</label>
                                                            <select class="form-control edit-karyawan-dropdown"
                                                                id="edit_karyawan_id{{ $lembur->id }}"
                                                                name="karyawan_id" required>
                                                                <option value="">Pilih Karyawan</option>
                                                                <!-- Karyawan sesuai jabatan akan diisi via JavaScript -->
                                                                <!-- Tapi kita tetap perlu menampilkan karyawan yang sudah dipilih -->
                                                                <option value="{{ $lembur->karyawan->id }}" selected>
                                                                    {{ $lembur->karyawan->user->karyawan }}
                                                                </option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Karyawan harus dipilih
                                                            </div>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="edit_tanggal{{ $lembur->id }}">Tanggal
                                                                Lembur</label>
                                                            <input type="date" class="form-control"
                                                                id="edit_tanggal{{ $lembur->id }}" name="tanggal"
                                                                required value="{{ $lembur->tanggal }}">
                                                            <div class="invalid-feedback">
                                                                Tanggal lembur harus diisi
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="edit_jam_mulai{{ $lembur->id }}">Jam
                                                                        Mulai</label>
                                                                    <input type="time" class="form-control"
                                                                        id="edit_jam_mulai{{ $lembur->id }}"
                                                                        name="jam_mulai" required
                                                                        value="{{ $lembur->jam_mulai }}">
                                                                    <div class="invalid-feedback">
                                                                        Jam mulai harus diisi
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="edit_jam_selesai{{ $lembur->id }}">Jam
                                                                        Selesai</label>
                                                                    <input type="time" class="form-control"
                                                                        id="edit_jam_selesai{{ $lembur->id }}"
                                                                        name="jam_selesai" required
                                                                        value="{{ $lembur->jam_selesai }}">
                                                                    <div class="invalid-feedback">
                                                                        Jam selesai harus diisi
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        
                        @if(count($lemburs) == 0)
                            <div class="text-center p-4">
                                <div class="alert alert-info" role="alert">
                                    Tidak ada data lembur untuk filter yang dipilih.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- end cardaa -->
            </div> <!-- end col -->
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        data-bs-scroll="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('lembur.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLemburLabel">Tambah Data Lembur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                    <!-- Dalam modal form tambah lembur -->
                    <div class="modal-body">
                        <!-- Jabatan (Ditambahkan) -->
                        <div class="mb-3">
                            <label for="jabatan_id" class="form-label">Jabatan</label>
                            <select name="jabatan_id" id="jabatan_id" class="form-control" required>
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Jabatan wajib dipilih.</div>
                        </div>

                        <!-- Karyawan (Dimodifikasi) -->
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Karyawan</label>
                            <select name="karyawan_id" id="karyawan_id" class="form-control" required disabled>
                                <option value="">Pilih Karyawan</option>
                                <!-- Karyawan akan diisi melalui AJAX -->
                            </select>
                            <div class="invalid-feedback">Karyawan wajib dipilih.</div>
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Lembur</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            <div class="invalid-feedback">Tanggal wajib diisi.</div>
                        </div>

                        <!-- Jam Mulai & Selesai -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                                        required>
                                    <div class="invalid-feedback">Jam mulai wajib diisi.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                    <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                                        required>
                                    <div class="invalid-feedback">Jam selesai wajib diisi.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Tambahkan script ini di bagian bawah halaman atau di bagian scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan elemen dropdown
            const jabatanDropdown = document.getElementById('jabatan_id');
            const karyawanDropdown = document.getElementById('karyawan_id');

            // Menambahkan event listener untuk perubahan pada dropdown jabatan
            jabatanDropdown.addEventListener('change', function() {
                const selectedJabatanId = this.value;

                // Reset dropdown karyawan
                karyawanDropdown.innerHTML = '<option value="">Pilih Karyawan</option>';

                // Jika tidak ada jabatan yang dipilih, disable dropdown karyawan
                if (!selectedJabatanId) {
                    karyawanDropdown.disabled = true;
                    return;
                }

                // Fetch karyawan berdasarkan jabatan yang dipilih
                fetch(`/get-karyawan-by-jabatan/${selectedJabatanId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Enable dropdown karyawan
                        karyawanDropdown.disabled = false;

                        // Mengisi dropdown karyawan dengan data yang diterima
                        // Menggunakan nama_karyawan sesuai dengan model Anda
                        data.forEach(karyawan => {
                            const option = document.createElement('option');
                            option.value = karyawan.id;
                            option.textContent = karyawan.nama_karyawan;
                            karyawanDropdown.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memuat data karyawan.');
                    });
            });
            
            // Menambahkan event listener untuk semua dropdown edit-jabatan-dropdown
            document.querySelectorAll('.edit-jabatan-dropdown').forEach(function(dropdown) {
                dropdown.addEventListener('change', function() {
                    const selectedJabatanId = this.value;
                    const lemburId = this.dataset.lemburId;
                    const karyawanDropdown = document.getElementById(`edit_karyawan_id${lemburId}`);
                    
                    // Reset dropdown karyawan
                    karyawanDropdown.innerHTML = '<option value="">Pilih Karyawan</option>';
                    
                    // Jika tidak ada jabatan yang dipilih, disable dropdown karyawan
                    if (!selectedJabatanId) {
                        return;
                    }
                    
                    // Fetch karyawan berdasarkan jabatan yang dipilih
                    fetch(`/get-karyawan-by-jabatan/${selectedJabatanId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Mengisi dropdown karyawan dengan data yang diterima
                            data.forEach(karyawan => {
                                const option = document.createElement('option');
                                option.value = karyawan.id;
                                option.textContent = karyawan.nama_karyawan;
                                karyawanDropdown.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memuat data karyawan.');
                        });
                });
            });
        });
    </script>
</x-app>