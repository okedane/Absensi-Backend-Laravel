<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan MOORA</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2>Laporan Hasil MOORA</h2>
    <p><strong>Jabatan:</strong> {{ $jabatan->nama_jabatan }}</p>
    <p><strong>Periode:</strong> {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Nilai Akhir (Yi)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilMoora as $index => $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data['nama_karyawan'] }}</td>
                    <td>{{ number_format($data['yi'], 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
