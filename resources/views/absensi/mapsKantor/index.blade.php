<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Lokasi Restoran</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Lokasi Restoran</li>
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
                                    <th>Nama Lokasi</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Radius (meter)</th>
                                    <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($LokasiRestoran as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_lokasi }}</td>
                                        <td>{{ $item->latitude }}</td>
                                        <td>{{ $item->longitude }}</td>
                                        <td>{{ $item->radius_meter }}</td>
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

                                                    <form action="{{ route('lokasi-absensi.delete', $item->id) }}"
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
                                                                    Apakah Anda yakin ingin menghapus Lokasi Restoran
                                                                    <strong>{{ $item->nama_lokasi }}</strong>?
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
                                                                        Data Lokasi Restoran</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form class="needs-validation"
                                                                    action="{{ route('lokasi-absensi.put', $item->id) }}"
                                                                    method="POST" novalidate>
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Pilih Lokasi di
                                                                                Map</label>
                                                                            <div id="editMap{{ $item->id }}"
                                                                                style="height: 300px;"></div>
                                                                        </div>


                                                                        <!-- Nama -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="nama">Nama Lokasi</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nama_lokasi" name="nama_lokasi"
                                                                                value="{{ $item->nama_lokasi }}"
                                                                                required>
                                                                            <div class="invalid-feedback">Nama harus
                                                                                diisi.</div>
                                                                        </div>
                                                                        <!-- Latitude -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="latitude">Latitude</label>
                                                                            <input type="text" class="form-control"
                                                                                id="latitude" name="latitude"
                                                                                value="{{ $item->latitude }}"
                                                                                required>
                                                                            <div class="invalid-feedback">Latitude
                                                                                harus
                                                                                diisi.</div>
                                                                        </div>
                                                                        <!-- Longitude -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="longitude">Longitude</label>
                                                                            <input type="text" class="form-control"
                                                                                id="longitude" name="longitude"
                                                                                value="{{ $item->longitude }}"
                                                                                required>
                                                                            <div class="invalid-feedback">Longitude
                                                                                harus
                                                                                diisi.</div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="radius_meter">Radius
                                                                                (meter)
                                                                            </label>
                                                                            <input type="number" class="form-control"
                                                                                id="radius_meter" name="radius_meter"
                                                                                value="{{ $item->radius_meter }}"
                                                                                required>
                                                                            <div class="invalid-feedback">Radius
                                                                                harus
                                                                                diisi.</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        {{-- <button type="reset" --}}
                                                                            {{-- class="btn btn-secondary">Reset</button> --}}
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan</button>
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
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true" data-bs-scroll="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Tambah Lokasi Restoran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="{{ route('lokasi-absensi.post') }}"
                                        method="POST" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Pilih Lokasi di Map</label>
                                            <div id="createMap" style="height: 300px;"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Nama Lokasi</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Masukkan Nama Lokasi" name="nama_lokasi" required>
                                            <div class="invalid-feedback">
                                                Nama harus diisi
                                            </div>
                                        </div>
                                        {{-- latitude --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">Latitude</label>
                                            <input type="text" class="form-control" id="validationCustom02"
                                                placeholder="Masukkan Latitude Lokasi" name="latitude" required>
                                            <div class="invalid-feedback">
                                                Latitude harus diisi
                                            </div>
                                        </div>
                                        {{-- longitude --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom03">Longitude</label>
                                            <input type="text" class="form-control" id="validationCustom03"
                                                placeholder="Masukkan Longitude Lokasi" name="longitude" required>
                                            <div class="invalid-feedback">
                                                Longitude harus diisi
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="radius_meter">Radius (meter)</label>
                                            <input type="number" class="form-control" id="radius_meter"
                                                name="radius_meter" placeholder="Masukkan Radius Lokasi" required>
                                            <div class="invalid-feedback">
                                                Radius harus diisi
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end preview-->

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <script>
        // ==========================
        // === Map for Create Modal ===
        // ==========================
        let createMap = L.map('createMap').setView([-6.2, 106.8], 13); // default Jakarta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(createMap);

        let createMarker;

        createMap.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(6);
            const lng = e.latlng.lng.toFixed(6);

            if (createMarker) {
                createMap.removeLayer(createMarker);
            }

            createMarker = L.marker([lat, lng]).addTo(createMap);
            document.getElementById('validationCustom02').value = lat;
            document.getElementById('validationCustom03').value = lng;
        });

        // Perbaikan agar peta tampil saat modal dibuka
        document.querySelector('[data-bs-target="#myModal"]').addEventListener('click', function() {
            setTimeout(() => {
                createMap.invalidateSize();
            }, 500);
        });


        // ==========================
        // === Maps for Edit Modals ===
        // ==========================
        @foreach ($LokasiRestoran as $item)
            const editMap{{ $item->id }} = L.map('editMap{{ $item->id }}').setView([{{ $item->latitude }},
                {{ $item->longitude }}
            ], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(editMap{{ $item->id }});
            let marker{{ $item->id }} = L.marker([{{ $item->latitude }}, {{ $item->longitude }}]).addTo(
                editMap{{ $item->id }});

            editMap{{ $item->id }}.on('click', function(e) {
                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);

                marker{{ $item->id }}.setLatLng([lat, lng]);
                document.querySelector('#editModal{{ $item->id }} input[name="latitude"]').value = lat;
                document.querySelector('#editModal{{ $item->id }} input[name="longitude"]').value = lng;
            });

            // Pastikan map tampil ketika modal dibuka
            document.querySelector('[data-bs-target="#editModal{{ $item->id }}"]').addEventListener('click',
                function() {
                    setTimeout(() => {
                        editMap{{ $item->id }}.invalidateSize();
                    }, 500);
                });
        @endforeach
    </script>

</x-app>
