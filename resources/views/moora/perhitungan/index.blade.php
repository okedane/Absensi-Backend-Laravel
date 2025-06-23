<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">moora</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">moora</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                   
                    <form method="GET" action="{{ route('moora.hasil', $jabatan_id) }}" class="row g-3 align-items-center mb-4">
                        <div class="col-md-3">
                            <label for="bulan" class="form-label mb-1">Bulan</label>
                            <select name="bulan" id="bulan" class="form-select" required>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun" class="form-label mb-1">Tahun</label>
                            <select name="tahun" id="tahun" class="form-select" required>
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2" style="margin-top: 39px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="{{ route('moora.hasil', $jabatan_id) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </form>
                    @if (!empty($matriksKeputusan))
                        <h2 class="mb-4">Matriks Keputusan</h2>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    @foreach (array_keys(current($matriksKeputusan)['keputusan']) as $id_kriteria)
                                        <th>C{{ $id_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matriksKeputusan as $index => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['nama_karyawan'] }}</td>
                                        @foreach ($data['keputusan'] as $bobot)
                                            <td>{{ $bobot }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada data matriks keputusan.</p>
                    @endif


                    @if (!empty($normalisasi))
                        <h2 class="mt-5 mb-4">Normalisasi Matriks</h2>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    @foreach (array_keys(current($normalisasi)['normalisasi']) as $id_kriteria)
                                        <th>C{{ $id_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($normalisasi as $index => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['nama_karyawan'] }}</td>
                                        @foreach ($data['normalisasi'] as $nilai)
                                            <td>{{ number_format($nilai, 4) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada data normalisasi.</p>
                    @endif


                    @if (!empty($matriksTerbobot))
                        <h2 class="mt-5 mb-4">Matriks Ternormalisasi Terbobot</h2>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    @foreach ($matriksTerbobot[array_key_first($matriksTerbobot)]['terbobot'] as $id_kriteria => $nilai)
                                        <th>C{{ $id_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matriksTerbobot as $index => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['nama_karyawan'] }}</td>
                                        @foreach ($data['terbobot'] as $nilai)
                                            <td>{{ number_format($nilai, 6) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada data matriksTerbobot.</p>
                    @endif

                </div>


                @if (!empty($hasilMoora))
                    <h2 class="mt-5 mb-4">Perhitungan Max, Min, dan Yi</h2>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Max (Benefit)</th>
                                <th>Min (Cost)</th>
                                <th>Yi (Max - Min)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasilMoora as $index => $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data['nama_karyawan'] }}</td>
                                    <td>{{ number_format($data['max'], 6) }}</td>
                                    <td>{{ number_format($data['min'], 6) }}</td>
                                    <td>{{ number_format($data['yi'], 6) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada data Hasil Moora.</p>
                @endif


                <!-- end cardaa -->
            </div>
        </div>
    </div>

</x-app>
