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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Daftar Penilaian</h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light"
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
                                                    <button type="submit" class="btn btn-soft-danger waves-effect waves-light">
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
                                                <select name="penilaian[{{ $kriteria->id }}]" class="form-control"
                                                    required>
                                                    <option disabled selected>Pilih Sub Kriteria</option>
                                                    @foreach ($kriteria->subKriterias as $sub)
                                                        <option value="{{ $sub->bobot }}">{{ $sub->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Bulan</label>
                                                <input type="number" name="bulan" min="1" max="12"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tahun</label>
                                                <input type="number" name="tahun" min="2000" max="2100"
                                                    class="form-control" required>
                                            </div>
                                        </div>
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

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Penilaian Karyawan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('penilaianKaryawan.update', ':id') }}" method="POST"
                                    id="editForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama Karyawan</label>
                                            <input type="text" class="form-control" id="editNamaKaryawan" readonly>
                                        </div>

                                        <!-- Input Nilai untuk Tiap Kriteria -->
                                        @foreach ($kriterias as $kriteria)
                                            <div class="mb-3">
                                                <label>{{ $kriteria->nama }}</label>
                                                <select name="penilaian[{{ $kriteria->id }}]" class="form-control"
                                                    required>
                                                    <option disabled selected>Pilih Sub Kriteria</option>
                                                    @foreach ($kriteria->subKriterias as $sub)
                                                        <option value="{{ $sub->bobot }}">{{ $sub->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Bulan</label>
                                                <input type="number" name="bulan" min="1" max="12"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tahun</label>
                                                <input type="number" name="tahun" min="2000" max="2100"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-edit').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    // Set form action
                    const karyawanId = this.getAttribute('data-karyawan');
                    document.getElementById('formEditPenilaian').action = '/penilaian-karyawan/' +
                        karyawanId;

                    // Set nama karyawan
                    document.getElementById('editKaryawanId').value = karyawanId;
                    document.getElementById('editNamaKaryawan').value = this.getAttribute(
                        'data-nama');

                    // Set nilai tiap kriteria
                    @foreach ($kriterias as $kriteria)
                        let nilai = this.getAttribute('data-kriteria-{{ $kriteria->id }}');
                        document.getElementById('editKriteria{{ $kriteria->id }}').value = nilai;
                    @endforeach

                    // Set bulan dan tahun
                    document.getElementById('editBulan').value = this.getAttribute('data-bulan');
                    document.getElementById('editTahun').value = this.getAttribute('data-tahun');
                });
            });
        });
    </script>
</x-app>
