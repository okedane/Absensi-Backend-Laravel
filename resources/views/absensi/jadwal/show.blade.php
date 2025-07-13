<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Detail Jadwal Kerja</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('jadwal-kerja.index') }}">Jadwal Kerja</a></li>
                                <li class="breadcrumb-item active">Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Karyawan -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Nama Karyawan:</strong></td>
                                            <td>{{ $jadwalUtama->karyawan->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jabatan:</strong></td>
                                            <td>{{ $jadwalUtama->karyawan->jabatan->nama_jabatan }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lokasi:</strong></td>
                                            <td>{{ $jadwalUtama->lokasi->nama_lokasi }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Periode:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($jadwalUtama->tanggal)->format('F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Hari Kerja:</strong></td>
                                            <td><span class="badge bg-success">{{ $detailJadwal->count() }} hari</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Jadwal Harian -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail Jadwal Harian</h4>
                            <a href="{{ route('jadwal-kerja.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Hari</th>
                                            <th>Shift</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Durasi Kerja</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailJadwal as $jadwal)
                                            @php
                                                $jamMasuk = \Carbon\Carbon::parse($jadwal->jam_masuk);
                                                $jamKeluar = \Carbon\Carbon::parse($jadwal->jam_keluar);
                                                $durasi = $jamKeluar->diff($jamMasuk);
                                                $tanggalJadwal = \Carbon\Carbon::parse($jadwal->tanggal);
                                                $isToday = $tanggalJadwal->isToday();
                                                $isPast = $tanggalJadwal->isPast();
                                                $isFuture = $tanggalJadwal->isFuture();
                                            @endphp
                                            <tr class="{{ $isToday ? 'table-warning' : ($isPast ? 'table-light' : '') }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tanggalJadwal->format('d/m/Y') }}</td>
                                                <td>{{ $tanggalJadwal->format('l') }}</td>
                                                <td>
                                                    <span class="badge {{ $jadwal->shift == 'pagi' ? 'bg-info' : 'bg-dark' }}">
                                                        {{ ucfirst($jadwal->shift) }}
                                                    </span>
                                                </td>
                                                <td>{{ $jamMasuk->format('H:i') }}</td>
                                                <td>{{ $jamKeluar->format('H:i') }}</td>
                                                <td>{{ $durasi->format('%h jam %i menit') }}</td>
                                                <td>
                                                    @if($isToday)
                                                        <span class="badge bg-warning">Hari Ini</span>
                                                    @elseif($isPast)
                                                        <span class="badge bg-success">Selesai</span>
                                                    @else
                                                        <span class="badge bg-primary">Mendatang</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <!-- Edit Button -->
                                                        <button type="button" class="btn btn-soft-primary btn-sm"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#editDetailModal{{ $jadwal->id }}"
                                                                title="Edit">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('jadwal-kerja.delete', $jadwal->id) }}" 
                                                              method="POST" 
                                                              id="deleteDetailForm{{ $jadwal->id }}" 
                                                              style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-soft-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteDetailModal{{ $jadwal->id }}"
                                                                    title="Hapus">
                                                                <i class="mdi mdi-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="editDetailModal{{ $jadwal->id }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Jadwal - {{ $tanggalJadwal->format('d/m/Y') }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <form action="{{ route('jadwal-kerja.put', $jadwal->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Tanggal</label>
                                                                            <input type="date" class="form-control" name="tanggal" 
                                                                                   value="{{ $jadwal->tanggal }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Shift</label>
                                                                            <select class="form-select" name="shift" required>
                                                                                <option value="pagi" {{ $jadwal->shift == 'pagi' ? 'selected' : '' }}>Pagi</option>
                                                                                <option value="malam" {{ $jadwal->shift == 'malam' ? 'selected' : '' }}>Malam</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Jam Masuk</label>
                                                                                    <input type="time" class="form-control" name="jam_masuk" 
                                                                                           value="{{ $jamMasuk->format('H:i') }}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Jam Keluar</label>
                                                                                    <input type="time" class="form-control" name="jam_keluar" 
                                                                                           value="{{ $jamKeluar->format('H:i') }}" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="karyawan_id" value="{{ $jadwal->karyawan_id }}">
                                                                        <input type="hidden" name="lokasi_id" value="{{ $jadwal->lokasi_id }}">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteDetailModal{{ $jadwal->id }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menghapus jadwal untuk tanggal 
                                                                       <strong>{{ $tanggalJadwal->format('d/m/Y') }}</strong>?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="button" class="btn btn-danger" 
                                                                            onclick="document.getElementById('deleteDetailForm{{ $jadwal->id }}').submit();">
                                                                        Hapus
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Summary -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title">Ringkasan Jadwal</h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <h4 class="text-primary">{{ $detailJadwal->count() }}</h4>
                                                        <p class="mb-0">Total Hari Kerja</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <h4 class="text-info">{{ $detailJadwal->where('shift', 'pagi')->count() }}</h4>
                                                        <p class="mb-0">Shift Pagi</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <h4 class="text-dark">{{ $detailJadwal->where('shift', 'malam')->count() }}</h4>
                                                        <p class="mb-0">Shift Malam</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        @php
                                                            $totalJam = 0;
                                                            foreach($detailJadwal as $j) {
                                                                $masuk = \Carbon\Carbon::parse($j->jam_masuk);
                                                                $keluar = \Carbon\Carbon::parse($j->jam_keluar);
                                                                $totalJam += $keluar->diffInHours($masuk);
                                                            }
                                                        @endphp
                                                        <h4 class="text-success">{{ $totalJam }}</h4>
                                                        <p class="mb-0">Total Jam Kerja</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>