<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">jabatan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">jabatan</li>
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
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:20px">No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($izins as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->karyawan->user->name }}</td>
                                        <td>{{ $item->karyawan->jabatan->nama_jabatan }}</td>
                                        <td>{{ $item->lokasi->nama_lokasi }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($item->status == 'disetujui')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif ($item->status == 'ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>

                                        <td style="text-align: center; width: 100px;">
                                            <div class="d-flex justify-content-center gap-2">
                                                <!-- Gunakan div container untuk menyusun tombol secara horizontal -->
                                                @if ($item->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif ($item->status == 'disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif ($item->status == 'ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                <!-- end cardaa -->
            </div> <!-- end col -->
        </div>
    </div>

</x-app>
