<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">MOORA</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">MOORA</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('moora.hasilAKhir', $jabatan_id) }}" class="row g-3 align-items-center mb-4">
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
                            <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
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

            @if (!empty($hasilMoora))
                <h2 class="mt-5 mb-4">Hasil</h2> <!-- 🔧 Perbaiki tag <h2> -->
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Nilai Akhir </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasilMoora as $index => $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data['nama_karyawan'] }}</td>
                                <td>{{ number_format($data['yi'], 4) }}</td> {{-- 🔧 gunakan key 'yi' --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada data hasil MOORA.</p>
            @endif
        </div>
    </div>
</x-app>
