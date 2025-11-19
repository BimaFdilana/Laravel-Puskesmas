<!DOCTYPE html>
<html>

<head>
    <title>Laporan Imunisasi</title>
</head>

<body>
    <table>
        <tr>
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

    @php
        // Kunci-kunci untuk iterasi yang lebih mudah
        $imunisasiKeys = [
            'HBO',
            'BCG',
            'Polio 1',
            'DPTHBHIB 1',
            'Polio 2',
            'DPTHBHIB 2',
            'Polio 3',
            'DPTHBHIB 3',
            'Polio 4',
            'IPV',
            'Campak',
            'DPTHBHIB Booster',
        ];
        $ttBumilKeys = ['TT3', 'TT4', 'TT5'];
        $ttWusKeys = ['TT3', 'TT4', 'TT5'];

        // Inisialisasi array total
        $totals = [];
        foreach ($imunisasiKeys as $key) {
            $totals[$key] = ['L' => 0, 'P' => 0];
        }
        $totals['BUMIL'] = [];
        foreach ($ttBumilKeys as $key) {
            $totals['BUMIL'][$key] = 0;
        }
        $totals['WUS'] = [];
        foreach ($ttWusKeys as $key) {
            $totals['WUS'][$key] = 0;
        }

        // Lakukan kalkulasi total
        foreach ($reportData as $row) {
            foreach ($imunisasiKeys as $key) {
                $totals[$key]['L'] += $row[$key]['L'] ?? 0;
                $totals[$key]['P'] += $row[$key]['P'] ?? 0;
            }
            foreach ($ttBumilKeys as $key) {
                $totals['BUMIL'][$key] += $row['BUMIL'][$key] ?? 0;
            }
            foreach ($ttWusKeys as $key) {
                $totals['WUS'][$key] += $row['WUS'][$key] ?? 0;
            }
        }
    @endphp

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
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold;">JUMLAH</td>

                @foreach ($imunisasiKeys as $key)
                    <td style="text-align: center; font-weight: bold;">{{ $totals[$key]['L'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $totals[$key]['P'] }}</td>
                @endforeach

                @foreach ($ttBumilKeys as $key)
                    <td style="text-align: center; font-weight: bold;">{{ $totals['BUMIL'][$key] }}</td>
                @endforeach

                @foreach ($ttWusKeys as $key)
                    <td style="text-align: center; font-weight: bold;">{{ $totals['WUS'][$key] }}</td>
                @endforeach
            </tr>
        </tfoot>
    </table>

    <br>

    <table>
        <tr>
            <td colspan="26">&nbsp;</td>

            <td colspan="6" style="text-align: left;">
                Bengkalis,
            </td>
        </tr>

        <tr>
            <td colspan="26">&nbsp;</td>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="26">&nbsp;</td>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="26">&nbsp;</td>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="26">&nbsp;</td>
            <td colspan="6">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="26">&nbsp;</td>
            <td colspan="6" style="text-align: left; font-weight: bold;">
                TENGKU FITRIA RAHMADHANI AM.Keb
            </td>
        </tr>

        <tr>
            <td colspan="26">&nbsp;</td>
            <td colspan="6" style="text-align: left;">
                Nr. PTT 873.446.2021.037
            </td>
        </tr>
    </table>
</body>

</html>
