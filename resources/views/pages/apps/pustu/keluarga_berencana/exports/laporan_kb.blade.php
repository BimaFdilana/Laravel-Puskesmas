<!DOCTYPE html>
<html>

<body>
    <table>
        <tr>
            <td colspan="23" style="text-align: center; font-weight: bold; font-size: 14px;">LAPORAN KELUARGA BERENCANA
            </td>
        </tr>
        <tr>
            <td colspan="23" style="text-align: center; font-weight: bold; font-size: 14px;">TAHUN {{ $tahun }}
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td>DESA</td>
            <td>: Sebauk</td>
        </tr>
        <tr>
            <td>BULAN / TAHUN</td>
            <td>: {{ $namaBulan }}</td>
        </tr>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th rowspan="3" style="vertical-align: middle;">NO</th>
                <th rowspan="3" style="vertical-align: middle;">NAMA POSYANDU</th>
                <th colspan="21" style="text-align: center;">JENIS KONTRASEPSI</th>
            </tr>
            <tr>
                <th colspan="3" style="text-align: center;">PIL</th>
                <th colspan="3" style="text-align: center;">SUNTIK</th>
                <th colspan="3" style="text-align: center;">KONDOM</th>
                <th colspan="3" style="text-align: center;">IUD</th>
                <th colspan="3" style="text-align: center;">IMPLAN</th>
                <th colspan="3" style="text-align: center;">MOW</th>
                <th colspan="3" style="text-align: center;">MOP</th>
            </tr>
            <tr>
                @for ($i = 0; $i < 7; $i++)
                    <th>UMUM</th>
                    <th>BPJS/K</th>
                    <th>PASCA SALIN</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @forelse ($reportData as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['nama_desa'] }}</td>
                    <td>{{ $row['PIL']['UMUM'] }}</td>
                    <td>{{ $row['PIL']['BPJS/K'] }}</td>
                    <td>{{ $row['PIL']['PASCA SALIN'] }}</td>
                    <td>{{ $row['SUNTIK']['UMUM'] }}</td>
                    <td>{{ $row['SUNTIK']['BPJS/K'] }}</td>
                    <td>{{ $row['SUNTIK']['PASCA SALIN'] }}</td>
                    <td>{{ $row['KONDOM']['UMUM'] }}</td>
                    <td>{{ $row['KONDOM']['BPJS/K'] }}</td>
                    <td>{{ $row['KONDOM']['PASCA SALIN'] }}</td>
                    <td>{{ $row['IUD']['UMUM'] }}</td>
                    <td>{{ $row['IUD']['BPJS/K'] }}</td>
                    <td>{{ $row['IUD']['PASCA SALIN'] }}</td>
                    <td>{{ $row['IMPLAN']['UMUM'] }}</td>
                    <td>{{ $row['IMPLAN']['BPJS/K'] }}</td>
                    <td>{{ $row['IMPLAN']['PASCA SALIN'] }}</td>
                    <td>{{ $row['MOW']['UMUM'] }}</td>
                    <td>{{ $row['MOW']['BPJS/K'] }}</td>
                    <td>{{ $row['MOW']['PASCA SALIN'] }}</td>
                    <td>{{ $row['MOP']['UMUM'] }}</td>
                    <td>{{ $row['MOP']['BPJS/K'] }}</td>
                    <td>{{ $row['MOP']['PASCA SALIN'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="23" style="text-align: center;">Tidak ada data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
