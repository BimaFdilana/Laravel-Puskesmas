<!DOCTYPE html>
<html>

<body>
    <table>
        <tr>
            <td colspan="29" style="text-align:center; font-weight:bold; font-size:14px;">SURVEILANS TERPADU PENYAKIT
                BERBASIS PUSKESMAS SENTINEL (KASUS BARU)</td>
        </tr>
        <tr></tr>
        <tr>
            <td>Provinsi</td>
            <td>: Riau</td>
            <td colspan="21"></td>
            <td>Tahun</td>
            <td>: {{ $tahun }}</td>
        </tr>
        <tr>
            <td>Kabupaten</td>
            <td>: Bengkalis</td>
            <td colspan="21"></td>
            <td>Bulan</td>
            <td>: {{ $namaBulan }}</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
    </table>

    <table>
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle;">No</th>
                <th rowspan="2" style="vertical-align: middle;">Penyakit</th>
                <th colspan="24" style="text-align: center;">Golongan Umur (tahun)</th>
                <th colspan="2" style="text-align: center;">/</th>
                <th rowspan="2" style="vertical-align: middle;">Total Kunjungan</th>
            </tr>
            <tr>
                <th colspan="2">0-7 Hr</th>
                <th colspan="2">8-28 Hr</th>
                <th colspan="2">
                    < 1</th>
                <th colspan="2">1-4</th>
                <th colspan="2">5-9</th>
                <th colspan="2">10-14</th>
                <th colspan="2">15-19</th>
                <th colspan="2">20-44</th>
                <th colspan="2">45-54</th>
                <th colspan="2">55-59</th>
                <th colspan="2">60-69</th>
                <th colspan="2">70+</th>
                <th>Laki</th>
                <th>Perp</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                @for ($i = 0; $i < 12; $i++)
                    <th>L</th>
                    <th>P</th>
                @endfor
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $columnTotals = [];
            @endphp
            @foreach ($reportData as $index => $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row['nama_penyakit'] }}</td>
                    @foreach (['0-7 Hr', '8-28 Hr', '< 1', '1-4', '5-9', '10-14', '15-19', '20-44', '45-54', '55-59', '60-69', '70+'] as $key)
                        <td>{{ $row[$key]['L'] }}</td>
                        <td>{{ $row[$key]['P'] }}</td>
                        @php
                            $columnTotals[$key]['L'] = ($columnTotals[$key]['L'] ?? 0) + $row[$key]['L'];
                            $columnTotals[$key]['P'] = ($columnTotals[$key]['P'] ?? 0) + $row[$key]['P'];
                        @endphp
                    @endforeach
                    <td>{{ $totalL = $row['total']['L'] }}</td>
                    <td>{{ $totalP = $row['total']['P'] }}</td>
                    <td>{{ $totalL + $totalP }}</td>
                    @php
                        $columnTotals['total']['L'] = ($columnTotals['total']['L'] ?? 0) + $totalL;
                        $columnTotals['total']['P'] = ($columnTotals['total']['P'] ?? 0) + $totalP;
                    @endphp
                </tr>
            @endforeach
            <tr style="font-weight: bold;">
                <td colspan="2" style="text-align: center;">TOTAL</td>
                @foreach (['0-7 Hr', '8-28 Hr', '< 1', '1-4', '5-9', '10-14', '15-19', '20-44', '45-54', '55-59', '60-69', '70+'] as $key)
                    <td>{{ $columnTotals[$key]['L'] ?? 0 }}</td>
                    <td>{{ $columnTotals[$key]['P'] ?? 0 }}</td>
                @endforeach
                <td>{{ $columnTotals['total']['L'] ?? 0 }}</td>
                <td>{{ $columnTotals['total']['P'] ?? 0 }}</td>
                <td>{{ ($columnTotals['total']['L'] ?? 0) + ($columnTotals['total']['P'] ?? 0) }}</td>
            </tr>
        </tbody>
    </table>

    <br>

    <table>
        <tr>
            <td colspan="23">&nbsp;</td>

            <td colspan="6" style="text-align: left;">
                Bengkalis,
            </td>
        </tr>

        <tr>
            <td colspan="23">&nbsp;</td>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="23">&nbsp;</td>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="23">&nbsp;</td>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="23">&nbsp;</td>
            <td colspan="6">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="23">&nbsp;</td>
            <td colspan="6" style="text-align: left; font-weight: bold;">
                TENGKU FITRIA RAHMADHANI AM.Keb
            </td>
        </tr>

        <tr>
            <td colspan="23">&nbsp;</td>
            <td colspan="6" style="text-align: left;">
                Nr. PTT 873.446.2021.037
            </td>
        </tr>
    </table>
</body>

</html>
