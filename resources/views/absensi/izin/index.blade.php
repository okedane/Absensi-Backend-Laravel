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
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:20px">No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($izins as $item)
                                    <tr>
                                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $item->karyawan->user->name }}</td>
                                        <td class="align-middle">{{ $item->karyawan->jabatan->nama_jabatan }}</td>
                                        <td class="align-middle">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }}</td>
                                        <td class="align-middle">{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</td>
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
                                            <form action="{{ route('izin.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button name="status" value="disetujui"
                                                    class="btn btn-success btn-sm mb-1" title="Setujui" {{ $item->status != 'pending' ? 'disabled' : '' }}>
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button name="status" value="ditolak"
                                                    class="btn btn-danger btn-sm mb-1" title="Tolak" {{ $item->status != 'pending' ? 'disabled' : '' }}>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
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
