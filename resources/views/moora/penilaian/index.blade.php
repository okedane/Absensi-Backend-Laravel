<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Penilaian Karyawan</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('penilaian.index') }}">jabatan</a></li>
                                <li class="breadcrumb-item active">Penilaian</li>
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
                            <button type="button" class="btn btn-success waves-effect waves-light mt-3 mt-md-0"
                                data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="mdi mdi-plus"></i> Create
                            </button>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('penilaianKaryawan.filter', $jabatan->id) }}"
                                class="row g-2 align-items-end mb-0">

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-0">Bulan</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="mdi mdi-calendar-month"></i>
                                        </span>
                                        <select name="bulan" class="form-control" required>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $i == request('bulan', now()->month) ? 'selected' : '' }}>
                                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-0">Tahun</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="mdi mdi-calendar-range"></i>
                                        </span>
                                        <select name="tahun" class="form-select" required>
                                            @for ($y = now()->year; $y >= 2020; $y--)
                                                <option value="{{ $y }}"
                                                    {{ (string) request('tahun', now()->year) === (string) $y ? 'selected' : '' }}>
                                                    {{ $y }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex gap-2 align-items-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-filter-variant"></i> Filter
                                    </button>
                                    <a href="{{ route('penilaianKaryawan.filter', $jabatan->id) }}"
                                        class="btn btn-secondary">
                                        <i class="mdi mdi-refresh"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    @foreach ($kriterias as $kriteria)
                                        <th>{{ $kriteria->nama }}</th>
                                    @endforeach
                                    <th style="text-align: center; width: 100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penilaian->groupBy('karyawan_id') as $index => $penilaianKaryawan)
                                    @php $first = $penilaianKaryawan->first(); @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $first->karyawan->user->name }}</td>
                                        @foreach ($kriterias as $kriteria)
                                            @php
                                                $nilai = $penilaianKaryawan->firstWhere('kriteria_id', $kriteria->id);
                                                $subNama = '-';
                                                if ($nilai) {
                                                    $sub = $kriteria->subKriterias->firstWhere('bobot', $nilai->nilai);
                                                    $subNama = $sub ? $sub->nama : $nilai->nilai;
                                                }
                                            @endphp
                                            <td>{{ $subNama }}</td>
                                        @endforeach

                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <button type="button"
                                                    data-bs-target="#editModal{{ $first->karyawan_id }}"
                                                    data-bs-toggle="modal"
                                                    class="btn btn-soft-primary waves-effect waves-light"
                                                    style="padding: 3px 6px;">
                                                    <i class="mdi mdi-pencil font-size-16 align-middle"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-soft-danger waves-effect waves-light"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $first->karyawan_id }}-{{ $first->bulan }}-{{ $first->tahun }}"
                                                    style="padding: 3px 6px;">
                                                    <i class="mdi mdi-trash-can font-size-16 align-middle"></i>
                                                </button>
                                            </div>

                                            <!-- Hidden form for delete -->
                                            <form action="{{ route('penilaianKaryawan.delete', $first->karyawan_id) }}"
                                                method="POST"
                                                id="deleteForm{{ $first->karyawan_id }}-{{ $first->bulan }}-{{ $first->tahun }}"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="bulan" value="{{ $first->bulan }}">
                                                <input type="hidden" name="tahun" value="{{ $first->tahun }}">
                                            </form>

                                            <!-- Modal Konfirmasi -->
                                            <div class="modal fade"
                                                id="deleteModal{{ $first->karyawan_id }}-{{ $first->bulan }}-{{ $first->tahun }}"
                                                tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin ingin menghapus penilaian
                                                            <strong>{{ $first->karyawan->user->name }}</strong>
                                                            bulan
                                                            <strong>{{ DateTime::createFromFormat('!m', $first->bulan)->format('F') }}</strong>
                                                            tahun <strong>{{ $first->tahun }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="document.getElementById('deleteForm{{ $first->karyawan_id }}-{{ $first->bulan }}-{{ $first->tahun }}').submit();">
                                                                Hapus
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit untuk setiap karyawan -->
                                    <div class="modal fade" id="editModal{{ $first->karyawan_id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $first->karyawan_id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Penilaian Karyawan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form
                                                    action="{{ route('penilaianKaryawan.update', $first->karyawan_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <!-- Kirim bulan dan tahun terpilih secara hidden -->
                                                        <input type="hidden" name="bulan"
                                                            value="{{ $bulan }}">
                                                        <input type="hidden" name="tahun"
                                                            value="{{ $tahun }}">

                                                        <!-- Tampilkan info bulan dan tahun -->
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Bulan</label>
                                                                <input type="text" class="form-control bg-light"
                                                                    value="{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Tahun</label>
                                                                <input type="text" class="form-control bg-light"
                                                                    value="{{ $tahun }}" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Karyawan</label>
                                                            <input type="text" class="form-control bg-light"
                                                                value="{{ $first->karyawan->user->name }}" disabled>
                                                        </div>

                                                        <!-- Input Nilai untuk Tiap Kriteria -->
                                                        @foreach ($kriterias as $kriteria)
                                                            @php
                                                                $nama = strtolower($kriteria->nama);
                                                                if ($nama === 'keterlambatan' || $nama === 'lembur') {
                                                                    continue;
                                                                }

                                                                $nilai = $penilaianKaryawan->firstWhere(
                                                                    'kriteria_id',
                                                                    $kriteria->id,
                                                                );
                                                                $currentValue = $nilai ? $nilai->nilai : '';
                                                            @endphp

                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label">{{ $kriteria->nama }}</label>
                                                                <select name="penilaian[{{ $kriteria->id }}]"
                                                                    class="form-control" required>
                                                                    <option disabled>Pilih Sub Kriteria</option>
                                                                    @foreach ($kriteria->subKriterias as $sub)
                                                                        <option value="{{ $sub->bobot }}"
                                                                            {{ $currentValue == $sub->bobot ? 'selected' : '' }}>
                                                                            {{ $sub->nama }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endforeach


                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
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

                <!-- Modal Tambah -->
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Penilaian Karyawan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('penilaianKaryawan.post') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <!-- Kirim bulan dan tahun terpilih secara hidden -->
                                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">

                                    <!-- Tampilkan info bulan dan tahun -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Bulan</label>
                                            <input type="text" class="form-control bg-light"
                                                value="{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tahun</label>
                                            <input type="text" class="form-control bg-light"
                                                value="{{ $tahun }}" disabled>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Pilih Karyawan</label>
                                        <select name="karyawan_id" class="form-control" required>
                                            @foreach ($karyawans as $karyawan)
                                                <option value="{{ $karyawan->id }}">{{ $karyawan->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @foreach ($kriterias as $kriteria)
                                        @php
                                            $nama = strtolower($kriteria->nama);
                                        @endphp

                                        @if ($nama === 'keterlambatan' || $nama === 'lembur')
                                            @continue
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label">{{ $kriteria->nama }}</label>
                                            <select name="penilaian[{{ $kriteria->id }}]" class="form-control"
                                                required>
                                                <option disabled selected>Pilih value</option>
                                                @foreach ($kriteria->subKriterias as $sub)
                                                    <option value="{{ $sub->bobot }}">{{ $sub->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach


                                </div>

                                <div class="modal-footer">
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</x-app>
