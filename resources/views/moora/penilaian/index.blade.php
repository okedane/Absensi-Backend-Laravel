<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Penilaian Karyawan</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Penilaian</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                            <form method="GET" action="{{ route('penilaianKaryawan.filter', $jabatan->id) }}"
                                class="row g-2 align-items-center mb-0">
                                <div class="col-auto">
                                    <select name="bulan" class="form-control" required>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"
                                                {{ (string)request('bulan', now()->month) === (string)$i ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="tahun" class="form-control" required>
                                        @for ($y = now()->year; $y >= 2020; $y--)
                                            <option value="{{ $y }}"
                                                {{ (string)request('tahun', now()->year) === (string)$y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('penilaianKaryawan.filter', $jabatan->id) }}" class="btn btn-secondary ms-1">Reset</a>
                                </div>
                            </form>
                            <button type="button" class="btn btn-primary waves-effect waves-light mt-2 mt-md-0"
                                data-bs-toggle="modal" data-bs-target="#myModal">Tambah Penilaian</button>
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
                                                    $nilai = $penilaianKaryawan->firstWhere(
                                                        'kriteria_id',
                                                        $kriteria->id,
                                                    );
                                                    $subNama = '-';
                                                    if ($nilai) {
                                                        $sub = $kriteria->subKriterias->firstWhere(
                                                            'bobot',
                                                            $nilai->nilai,
                                                        );
                                                        $subNama = $sub ? $sub->nama : $nilai->nilai;
                                                    }
                                                @endphp
                                                <td>{{ $subNama }}</td>
                                            @endforeach

                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn btn-soft-primary waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-karyawan="{{ $first->karyawan_id }}"
                                                    data-nama="{{ $first->karyawan->user->name }}"
                                                    @foreach ($kriterias as $kriteria)
                                                        data-kriteria-{{ $kriteria->id }}="{{ optional($penilaianKaryawan->firstWhere('kriteria_id', $kriteria->id))->nilai }}" @endforeach
                                                    data-bulan="{{ $first->bulan }}" data-tahun="{{ $first->tahun }}">
                                                    <i class="mdi mdi-pencil font-size-16 align-middle"></i>
                                                </button>
                                                <form
                                                    action="{{ route('penilaianKaryawan.delete', $first->karyawan_id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-soft-danger waves-effect waves-light">
                                                        <i class="mdi mdi-trash-can font-size-16 align-middle"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Bulan</label>
                                                <select name="bulan" class="form-control" required>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ now()->month == $i ? 'selected' : '' }}>
                                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Tahun</label>
                                                <select name="tahun" class="form-control" required>
                                                    @for ($year = now()->year; $year >= 2020; $year--)
                                                        <option value="{{ $year }}"
                                                            {{ now()->year == $year ? 'selected' : '' }}>
                                                            {{ $year }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>Pilih Karyawan</label>
                                            <select name="karyawan_id" class="form-control" required>
                                                @foreach ($karyawans as $karyawan)
                                                    <option value="{{ $karyawan->id }}">{{ $karyawan->user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Input Nilai untuk Tiap Kriteria -->
                                        @foreach ($kriterias as $kriteria)
                                            <div class="mb-3">
                                                <label>{{ $kriteria->nama }}</label>
                                                @if (strtolower($kriteria->nama) === 'keterlambatan')
                                                    <input type="text" class="form-control bg-light"
                                                        value="Nilai otomatis dari absensi" disabled>
                                                @elseif (strtolower($kriteria->nama) === 'lembur')
                                                    <input type="text" class="form-control bg-light"
                                                        value="Nilai otomatis dari lembur" disabled>
                                                @else
                                                    <select name="penilaian[{{ $kriteria->id }}]" class="form-control"
                                                        required>
                                                        <option disabled selected>Pilih Sub Kriteria</option>
                                                        @foreach ($kriteria->subKriterias as $sub)
                                                            <option value="{{ $sub->bobot }}">{{ $sub->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app>
