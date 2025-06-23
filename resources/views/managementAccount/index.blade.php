<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">User</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">User</li>
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
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:20px">No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="text-align: center; width: 100px;" class="no-export">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
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

                                                    <!-- Tombol Delete -->
                                                    <!-- Tombol Delete dengan Modal Konfirmasi -->
                                                    <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                                        id="deleteForm{{ $item->id }}">
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
                                                                    Apakah Anda yakin ingin menghapus pengguna
                                                                    <strong>{{ $item->name }}</strong>?
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
                                                    <!-- sample modal content -->
                                                    <div id="editModal{{ $item->id }}" class="modal fade"
                                                        tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                                                        data-bs-scroll="true" data-bs-backdrop="static">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="myModalLabel">edit
                                                                        akun</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form class="needs-validation"
                                                                    action="{{ route('users.update', $item->id) }}"
                                                                    method="POST" novalidate>
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="validationCustom01">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="validationCustom01"
                                                                                placeholder="Name" name="name"
                                                                                value="{{ $item->name }}" required>
                                                                            <div class="invalid-feedback">
                                                                                Please choose a unique and valid name.
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="validationCustom02">Email</label>
                                                                            <input type="email" class="form-control"
                                                                                id="validationCustom02"
                                                                                placeholder="Email" name="email"
                                                                                value="{{ $item->email }}" required>
                                                                            <div class="invalid-feedback">
                                                                                Please choose a unique and valid email.
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="validationCustom03">Password</label>
                                                                            <input type="password"
                                                                                class="form-control"
                                                                                id="validationCustom03"
                                                                                placeholder="Password"
                                                                                name="password">
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary waves-effect"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary waves-effect waves-light">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>

                                                            </div>

                                                        </div>
                                                        < </div><!-- /.modal-dialog -->
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
                    <!-- sample modal content -->
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true" data-bs-scroll="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">tambah akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="{{ route('users.store') }}" method="POST"
                                        novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Name</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Name" name="name" required>
                                            <div class="invalid-feedback">
                                                Please choose a unique and valid name.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">Email</label>
                                            <input type="email" class="form-control" id="validationCustom02"
                                                placeholder="Email" name="email" required>
                                            <div class="invalid-feedback">
                                                Please choose a unique and valid email.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom03">Password</label>
                                            <input type="password" class="form-control" id="validationCustom03"
                                                placeholder="Password" name="password" required>
                                            <div class="invalid-feedback">
                                                Password must be at least 8 characters long.
                                            </div>
                                        </div>
                                        <input type="hidden" name="role" id="role" value="admin">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Save
                                                changes</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                        < </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div> <!-- end preview-->

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>

</x-app>
