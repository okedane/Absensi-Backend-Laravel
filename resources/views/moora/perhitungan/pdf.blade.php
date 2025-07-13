<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan MOORA</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }

        h2 {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <h1>Laporan Hasil MOORA</h1>
    <p><strong>Jabatan:</strong> {{ $jabatan->nama_jabatan }}</p>
    <p><strong>Periode:</strong> {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</p>

    {{-- Matriks Keputusan --}}
    <h2>Matriks Keputusan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                @foreach ($kriterias as $k)
                    <th>C{{ $k->id }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($matriksKeputusan as $i => $data)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $data['nama_karyawan'] }}</td>
                    @foreach ($kriterias as $k)
                        <td>{{ number_format($data['keputusan'][$k->id], 2) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Normalisasi --}}
    <h2>Normalisasi Matriks</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                @foreach ($kriterias as $k)
                    <th>C{{ $k->id }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($normalisasi as $i => $data)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $data['nama_karyawan'] }}</td>
                    @foreach ($kriterias as $k)
                        <td>{{ number_format($data['normalisasi'][$k->id], 6) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Matriks Terbobot --}}
    <h2>Matriks Terbobot</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                @foreach ($kriterias as $k)
                    <th>C{{ $k->id }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($matriksTerbobot as $i => $data)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $data['nama_karyawan'] }}</td>
                    @foreach ($kriterias as $k)
                        <td>{{ number_format($data['terbobot'][$k->id], 6) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Yi --}}
    <h2>Perhitungan Yi (Max - Min)</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Benefit</th>
                <th>Cost</th>
                <th>Yi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilMoora as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item['nama_karyawan'] }}</td>
                    <td>{{ number_format($item['max'] ?? 0, 6) }}</td>
                    <td>{{ number_format($item['min'] ?? 0, 6) }}</td>
                    <td>{{ number_format($item['yi'], 6) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
