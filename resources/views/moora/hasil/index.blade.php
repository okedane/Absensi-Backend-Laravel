<x-app>
    <div class="page-content">
        <div class="container-fluid">

            <form method="GET" action="{{ route('moora.hasil') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <select name="bulan" class="form-control" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="tahun" class="form-control" required>
                            @for ($y = now()->year; $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-header">
                    <h4>Hasil Perhitungan MOORA</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>Nama Karyawan</th>
                                <th>Hasil Akhir (Benefit - Cost)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $i => $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row['karyawan']->user->name }}</td>
                                    <td>{{ number_format($row['nilai'], 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app>

