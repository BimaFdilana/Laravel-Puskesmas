<!DOCTYPE html>
<html>

<head>
    <title>Laporan Imunisasi</title>
</head>

<body>
    {{-- Informasi Header Laporan --}}
    <table>
        <tr>
            <td style="font-weight: bold;">Desa</td>
            <td>:</td>
            <td>SEBAUK</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Bulan</td>
            <td>:</td>
            <td>{{ $namaBulan }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Tahun</td>
            <td>:</td>
            <td>{{ $tahun }}</td>
        </tr>
    </table>

    <br>

    {{-- Tabel Utama Laporan --}}
    <table>
        <thead>
            <tr>
                <th rowspan="3" style="vertical-align: middle;">No</th>
                <th rowspan="3" style="vertical-align: middle;">Nama Posyandu</th>
                <th colspan="24" style="text-align: center;">Jumlah Bayi yang di Imunisasi</th>
                <th colspan="3" style="text-align: center;">TT BUMIL</th>
                <th colspan="3" style="text-align: center;">TT WUS</th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: center;">HBO</th>
                <th colspan="2" style="text-align: center;">BCG</th>
                <th colspan="2" style="text-align: center;">Polio 1</th>
                <th colspan="2" style="text-align: center;">DPTHBHIB 1</th>
                <th colspan="2" style="text-align: center;">Polio 2</th>
                <th colspan="2" style="text-align: center;">DPTHBHIB 2</th>
                <th colspan="2" style="text-align: center;">Polio 3</th>
                <th colspan="2" style="text-align: center;">DPTHBHIB 3</th>
                <th colspan="2" style="text-align: center;">Polio 4</th>
                <th colspan="2" style="text-align: center;">IPV</th>
                <th colspan="2" style="text-align: center;">Campak</th>
                <th colspan="2" style="text-align: center;">DPTHBHIB Booster</th>
                <th style="text-align: center;">TT3</th>
                <th style="text-align: center;">TT4</th>
                <th style="text-align: center;">TT5</th>
                <th style="text-align: center;">TT3</th>
                <th style="text-align: center;">TT4</th>
                <th style="text-align: center;">TT5</th>
            </tr>
            <tr>
                @for ($i = 0; $i < 12; $i++)
                    <th style="text-align: center;">L</th>
                    <th style="text-align: center;">P</th>
                @endfor
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['nama_posyandu'] }}</td>
                    <td>{{ $row['HBO']['L'] ?? 0 }}</td>
                    <td>{{ $row['HBO']['P'] ?? 0 }}</td>
                    <td>{{ $row['BCG']['L'] ?? 0 }}</td>
                    <td>{{ $row['BCG']['P'] ?? 0 }}</td>
                    <td>{{ $row['Polio 1']['L'] ?? 0 }}</td>
                    <td>{{ $row['Polio 1']['P'] ?? 0 }}</td>
                    <td>{{ $row['DPTHBHIB 1']['L'] ?? 0 }}</td>
                    <td>{{ $row['DPTHBHIB 1']['P'] ?? 0 }}</td>
                    <td>{{ $row['Polio 2']['L'] ?? 0 }}</td>
                    <td>{{ $row['Polio 2']['P'] ?? 0 }}</td>
                    <td>{{ $row['DPTHBHIB 2']['L'] ?? 0 }}</td>
                    <td>{{ $row['DPTHBHIB 2']['P'] ?? 0 }}</td>
                    <td>{{ $row['Polio 3']['L'] ?? 0 }}</td>
                    <td>{{ $row['Polio 3']['P'] ?? 0 }}</td>
                    <td>{{ $row['DPTHBHIB 3']['L'] ?? 0 }}</td>
                    <td>{{ $row['DPTHBHIB 3']['P'] ?? 0 }}</td>
                    <td>{{ $row['Polio 4']['L'] ?? 0 }}</td>
                    <td>{{ $row['Polio 4']['P'] ?? 0 }}</td>
                    <td>{{ $row['IPV']['L'] ?? 0 }}</td>
                    <td>{{ $row['IPV']['P'] ?? 0 }}</td>
                    <td>{{ $row['Campak']['L'] ?? 0 }}</td>
                    <td>{{ $row['Campak']['P'] ?? 0 }}</td>
                    <td>{{ $row['DPTHBHIB Booster']['L'] ?? 0 }}</td>
                    <td>{{ $row['DPTHBHIB Booster']['P'] ?? 0 }}</td>
                    <td>{{ $row['BUMIL']['TT3'] ?? 0 }}</td>
                    <td>{{ $row['BUMIL']['TT4'] ?? 0 }}</td>
                    <td>{{ $row['BUMIL']['TT5'] ?? 0 }}</td>
                    <td>{{ $row['WUS']['TT3'] ?? 0 }}</td>
                    <td>{{ $row['WUS']['TT4'] ?? 0 }}</td>
                    <td>{{ $row['WUS']['TT5'] ?? 0 }}</td>
                </tr>
            @endforeach
            @if (count($reportData) < 5)
                @for ($i = count($reportData); $i < 5; $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold;">JUMLAH</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
