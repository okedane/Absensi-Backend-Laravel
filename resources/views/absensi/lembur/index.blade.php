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
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <form method="GET" action="{{ route('lembur.index') }}" class="d-flex gap-2">
                                        <select name="jabatan" class="form-select">
                                            <option value="">Semua Jabatan</option>
                                            @foreach($jabatans as $jabatan)
                                                <option value="{{ $jabatan->id }}" 
                                                    {{ $sortJabatan == $jabatan->id ? 'selected' : '' }}>
                                                    {{ $jabatan->nama_jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-md-3">
                                        <select name="bulan" class="form-select">
                                            <option value="">Semua Bulan</option>
                                            @foreach($bulans as $key => $bulan)
                                                <option value="{{ $key }}" 
                                                    {{ $sortBulan == $key ? 'selected' : '' }}>
                                                    {{ $bulan }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                                        <a href="{{ route('lembur.index') }}" class="btn btn-secondary">Reset</a>
                                    </form>
                                </div>
                                <div class="col-md-3 text-end">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                                        <i class="mdi mdi-plus"></i> Tambah Lembur
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <!-- Alert Messages -->
            @if(session('success'))
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                </div>
            @endif --}}

            <!-- Data Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:20px">No</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jabatan</th>
                                        <th>Tanggal</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Total Jam</th>
                                        <th style="text-align: center; width: 120px;" class="no-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lemburs as $item)
                                        <tr>
                                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $item->karyawan->user->name }}</td>
                                            <td class="align-middle">
                                                <span class="badge badge-soft-secondary">
                                                    {{ $item->karyawan->jabatan->nama_jabatan }}
                                                </span>
                                            </td>
                                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</td>
                                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                                            <td class="align-middle">
                                                <span class="badge badge-soft-primary">{{ $item->total_jam }} jam</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button type="button" class="btn btn-soft-info btn-sm" 
                                                        onclick="showDetail({{ $item->id }})" title="Detail">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-soft-warning btn-sm" 
                                                        onclick="editLembur({{ $item->id }})" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('lembur.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="jabatan" value="{{ $sortJabatan }}">
                                                        <input type="hidden" name="bulan" value="{{ $sortBulan }}">
                                                        <button type="submit" class="btn btn-soft-danger btn-sm" 
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data lembur</td>
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

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Data Lembur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('lembur.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jabatan" value="{{ $sortJabatan }}">
                    <input type="hidden" name="bulan" value="{{ $sortBulan }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Karyawan <span class="text-danger">*</span></label>
                            <select name="karyawan_id" id="karyawan_id" class="form-select" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">
                                        {{ $karyawan->user->name }} - {{ $karyawan->jabatan->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_mulai" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                                    <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required autocomplete="off">
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Lembur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="jabatan" value="{{ $sortJabatan }}">
                    <input type="hidden" name="bulan" value="{{ $sortBulan }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_karyawan_id" class="form-label">Karyawan <span class="text-danger">*</span></label>
                            <select name="karyawan_id" id="edit_karyawan_id" class="form-select" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">
                                        {{ $karyawan->user->name }} - {{ $karyawan->jabatan->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_jam_mulai" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                    <input type="time" name="jam_mulai" id="edit_jam_mulai" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_jam_selesai" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                                    <input type="time" name="jam_selesai" id="edit_jam_selesai" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Lembur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4"><strong>Karyawan:</strong></div>
                        <div class="col-md-8" id="detail_karyawan"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Jabatan:</strong></div>
                        <div class="col-md-8" id="detail_jabatan"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Tanggal:</strong></div>
                        <div class="col-md-8" id="detail_tanggal"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Jam Mulai:</strong></div>
                        <div class="col-md-8" id="detail_jam_mulai"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Jam Selesai:</strong></div>
                        <div class="col-md-8" id="detail_jam_selesai"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Total Jam:</strong></div>
                        <div class="col-md-8" id="detail_total_jam"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function untuk edit lembur
        function editLembur(id) {
            fetch(`/lembur/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editForm').action = `/lembur/${id}`;
                    document.getElementById('edit_karyawan_id').value = data.karyawan_id;
                    document.getElementById('edit_tanggal').value = data.tanggal;
                    document.getElementById('edit_jam_mulai').value = data.jam_mulai;
                    document.getElementById('edit_jam_selesai').value = data.jam_selesai;
                    
                    // Show modal
                    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                    editModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                });
        }

        // Function untuk show detail
        function showDetail(id) {
            fetch(`/lembur/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail_karyawan').textContent = data.karyawan.user.name;
                    document.getElementById('detail_jabatan').textContent = data.karyawan.jabatan.nama_jabatan;
                    document.getElementById('detail_tanggal').textContent = new Date(data.tanggal).toLocaleDateString('id-ID', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    document.getElementById('detail_jam_mulai').textContent = data.jam_mulai;
                    document.getElementById('detail_jam_selesai').textContent = data.jam_selesai;
                    document.getElementById('detail_total_jam').textContent = data.total_jam + ' jam';
                    
                    // Show modal
                    var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                    detailModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                });
        }
    </script>
</x-app>