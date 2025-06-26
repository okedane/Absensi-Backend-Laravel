<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Daftar Karyawan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('jabatan.index') }}">Jabatan</a></li>
                                <li class="breadcrumb-item active">karyawan</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Jabatan {{ $jabatan->nama_jabatan }}</h5>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="mdi mdi-plus"></i> Tambah Karyawan
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:20px">No</th>
                                    <th>NK</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Email</th>

                                    <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nomor_karyawan }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->jabatan->nama_jabatan }}</td>
                                        <td>{{ $item->user->email }}</td>
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

                                                    <!-- Tombol Delete dengan Modal Konfirmasi -->
                                                    <form action="{{ route('karyawan.destroy', $item->id) }}"
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
                                                                    Apakah Anda yakin ingin menghapus karyawan
                                                                    <strong>{{ $item->user->name }}</strong>?
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
                                                                        Data karyawan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form class="needs-validation"
                                                                    action="{{ route('karyawan.update', $item->id) }}"
                                                                    method="POST" novalidate>
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="nama">Nomor Karyawan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nomor_karyawan"
                                                                                name="nomor_karyawan"
                                                                                value="{{ $item->nomor_karyawan }}"
                                                                                required>
                                                                            <div class="invalid-feedback">NK harus
                                                                                diisi.</div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="tanggal_masuk">Tanggal Masuk</label>
                                                                            <input type="date" class="form-control"
                                                                                id="tanggal_masuk"
                                                                                name="tanggal_masuk"
                                                                                value="{{ $item->tanggal_masuk }}"
                                                                                required>
                                                                        </div>
                                                                        <!-- Nama -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="nama">Nama</label>
                                                                            <input type="text" class="form-control"
                                                                                id="name"
                                                                                name="name"
                                                                                value="{{ $item->user->name ?? '' }}"
                                                                                required>
                                                                            <div class="invalid-feedback">Nama harus
                                                                                diisi.</div>
                                                                        </div>

                                                                        <!-- Email -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="email">Email</label>
                                                                            <input type="email" class="form-control"
                                                                                id="email" name="email"
                                                                                value="{{ $item->user->email ?? '' }}"
                                                                                required>
                                                                            <div class="invalid-feedback">Email harus
                                                                                valid dan diisi.</div>
                                                                        </div>

                                                                        <!-- Password -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="password">Password
                                                                                (Opsional)</label>
                                                                            <input type="password"
                                                                                class="form-control" id="password"
                                                                                name="password"
                                                                                placeholder="Biarkan kosong jika tidak ingin mengganti">
                                                                        </div>
                                                                        <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary waves-effect"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary waves-effect waves-light">Simpan
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
                    <!-- Modal content -->
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true" data-bs-scroll="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Tambah Karyawan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="{{ route('karyawan.store') }}"
                                        method="POST" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">nomor Karyawan</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Masukkan Nomor Karyawan" name="nomor_karyawan" required>
                                            <div class="invalid-feedback">
                                                Nomor karyawan harus diisi
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Nama Karyawan</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Masukkan Nama Karyawan" name="name" required>
                                            <div class="invalid-feedback">
                                                Nama karyawan harus diisi
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Tanggal Masuk</label>
                                            <input type="date" class="form-control" id="validationCustom01"
                                                placeholder="Masukkan Tanggal Masuk" name="tanggal_masuk" required>
                                            <div class="invalid-feedback">
                                                Tanggal masuk harus diisi
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">Email</label>
                                            <input type="email" class="form-control" id="validationCustom02"
                                                placeholder="Masukkan Email" name="email" required>
                                            <div class="invalid-feedback">
                                                Email harus diisi dan formatnya benar
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom03">Password</label>
                                            <input type="password" class="form-control" id="validationCustom03"
                                                placeholder="Masukkan Password" name="password" required>
                                            <div class="invalid-feedback">
                                                Password harus diisi
                                            </div>
                                        </div>

                                        <input type="hidden" name="role" value="karyawan">
                                        <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">


                                        <button class="btn btn-primary" type="submit">Tambah Karyawan</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div><!-- end preview -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>


</x-app>
