<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Izin</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Izin</li>
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
                            <form method="GET" action="{{ route('izin.index') }}" class="row g-3">
                                <div class="col-md-3">
                                    {{-- <label for="jabatan" class="form-label">Filter Jabatan</label> --}}
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
                                <div class="col-md-3">
                                    {{-- <label for="bulan" class="form-label">Filter Bulan</label> --}}
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
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                                    <a href="{{ route('izin.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Success -->
            @if(session('success'))
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:20px">No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th style="text-align: center; width: 120px;" class="no-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($izins as $item)
                                        <tr>
                                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $item->karyawan->user->name }}</td>
                                            <td class="align-middle">
                                                <span class="badge badge-soft-secondary">
                                                    {{ $item->karyawan->jabatan->nama_jabatan }}
                                                </span>
                                            </td>
                                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }}</td>
                                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</td>
                                            <td class="align-middle">
                                                @php
                                                    $durasi = \Carbon\Carbon::parse($item->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($item->tanggal_selesai)) + 1;
                                                @endphp
                                                <span class="badge badge-soft-info">{{ $durasi }} hari</span>
                                            </td>
                                            <td class="align-middle">
                                                @if ($item->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif ($item->status == 'disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif ($item->status == 'ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center" style="width: 120px;">
                                                @if ($item->status == 'pending')
                                                    <form action="{{ route('izin.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <!-- Hidden inputs untuk mempertahankan filter -->
                                                        <input type="hidden" name="jabatan" value="{{ $sortJabatan }}">
                                                        <input type="hidden" name="status" value="{{ $sortStatus }}">
                                                        <input type="hidden" name="bulan" value="{{ $sortBulan }}">
                                                        
                                                        <button name="status" value="disetujui"
                                                            class="btn btn-success btn-sm mb-1" title="Setujui"
                                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui izin ini?')">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button name="status" value="ditolak"
                                                            class="btn btn-danger btn-sm mb-1" title="Tolak"
                                                            onclick="return confirm('Apakah Anda yakin ingin menolak izin ini?')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <div class="text-muted small">
                                                        {{ ucfirst($item->status) }}
                                                        <br>
                                                        <small>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y H:i') }}</small>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data izin</td>
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