<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaporanRekapImunisasiExport implements WithEvents, WithTitle
{
    protected $data;
    protected $filters;

    public function __construct(Collection $data, array $filters)
    {
        $this->data = $data;
        $this->filters = $filters;
    }

    public function title(): string
    {
        return 'Laporan Imunisasi';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // --- Styling ---
                $headerStyle = ['font' => ['bold' => true], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true]];
                $allBorders = ['borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]];
                $centerAlign = ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]];

                // --- Header Laporan ---
                $sheet->setCellValue('C3', 'LAPORAN IMUNISASI DESA UPT PUSKESMAS MESKOM KEC. BENGKALIS');
                $sheet->mergeCells('C3:AH3'); // Disesuaikan hingga kolom terakhir
                $sheet->getStyle('C3')->getFont()->setBold(true);

                $sheet->setCellValue('C4', 'Desa');
                $sheet->setCellValue('D4', ': ' . $this->filters['desa']);
                $sheet->setCellValue('C5', 'Bulan');
                $namaBulan = date('F', mktime(0, 0, 0, $this->filters['bulan'], 10));
                $sheet->setCellValue('D5', ': ' . $namaBulan);
                $sheet->setCellValue('C6', 'Tahun');
                $sheet->setCellValue('D6', ': ' . $this->filters['tahun']);

                // --- Header Tabel ---
                $sheet->mergeCells('A8:A10')->setCellValue('A8', 'No');
                $sheet->mergeCells('B8:B10')->setCellValue('B8', 'Nama Posyandu');
                $sheet->mergeCells('C8:AB8')->setCellValue('C8', 'Jumlah Bayi yang di Imunisasi');
                $sheet->mergeCells('AC8:AE9')->setCellValue('AC8', 'TT BUMIL');
                $sheet->mergeCells('AF8:AH9')->setCellValue('AF8', 'TT WUS');

                $headers_imunisasi = [
                    'C9' => 'HBO',
                    'E9' => 'BCG',
                    'G9' => 'Polio 1',
                    'I9' => 'DPTHBHIB 1',
                    'K9' => 'Polio 2',
                    'M9' => 'DPTHBHIB 2',
                    'O9' => 'Polio 3',
                    'Q9' => 'DPTHBHIB 3',
                    'S9' => 'Polio 4',
                    'U9' => 'IPV',
                    'W9' => 'Campak',
                    'Y9' => 'DPTHBHIB Booster',
                    'AA9' => 'Campak Booster', // Diperbarui
                ];
                foreach ($headers_imunisasi as $cell => $value) {
                    $nextCell = chr(ord(substr($cell, 0, 1)) + 1) . '9';
                    $sheet->mergeCells($cell . ':' . $nextCell)->setCellValue($cell, $value);
                }
                $sheet->setCellValue('AC10', 'TT3');
                $sheet->setCellValue('AD10', 'TT4');
                $sheet->setCellValue('AE10', 'TT5');
                $sheet->setCellValue('AF10', 'TT3');
                $sheet->setCellValue('AG10', 'TT4');
                $sheet->setCellValue('AH10', 'TT5');

                $lp_cells = ['C', 'E', 'G', 'I', 'K', 'M', 'O', 'Q', 'S', 'U', 'W', 'Y', 'AA']; // Diperbarui
                foreach ($lp_cells as $col) {
                    $sheet->setCellValue($col . '10', 'L');
                    $sheet->setCellValue(chr(ord($col) + 1) . '10', 'P');
                }

                // --- Isi Data ---
                $rowNumber = 11;
                $nomor = 1;
                $totals = [];

                $dataColumns = ['hbo_l', 'hbo_p', 'bcg_l', 'bcg_p', 'polio1_l', 'polio1_p', 'dpthbhib1_l', 'dpthbhib1_p', 'polio2_l', 'polio2_p', 'dpthbhib2_l', 'dpthbhib2_p', 'polio3_l', 'polio3_p', 'dpthbhib3_l', 'dpthbhib3_p', 'polio4_l', 'polio4_p', 'ipv_l', 'ipv_p', 'campak_l', 'campak_p', 'dpthbhib_booster_l', 'dpthbhib_booster_p', 'campak_booster_l', 'campak_booster_p', 'tt_bumil_tt3', 'tt_bumil_tt4', 'tt_bumil_tt5', 'tt_wus_tt3', 'tt_wus_tt4', 'tt_wus_tt5'];

                foreach ($this->data as $posyanduData) {
                    $sheet->setCellValue('A' . $rowNumber, $nomor++);
                    $sheet->setCellValue('B' . $rowNumber, $posyanduData->nama_posyandu);
                    $colIndex = 'C';
                    foreach ($dataColumns as $column) {
                        $value = $posyanduData->{$column} ?? 0;
                        $sheet->setCellValue($colIndex . $rowNumber, $value);
                        if (!isset($totals[$column])) {
                            $totals[$column] = 0;
                        }
                        $totals[$column] += $value;
                        $colIndex++;
                    }
                    $rowNumber++;
                }

                // --- Baris Jumlah ---
                $sheet->mergeCells('A' . $rowNumber . ':B' . $rowNumber)->setCellValue('A' . $rowNumber, 'JUMLAH');
                $colIndex = 'C';
                foreach ($dataColumns as $column) {
                    $sheet->setCellValue($colIndex . $rowNumber, $totals[$column] ?? 0);
                    $colIndex++;
                }

                // --- Apply Style ---
                $lastCol = 'AH'; // Diperbarui
                $sheet->getStyle('A8:' . $lastCol . $rowNumber)->applyFromArray($allBorders);
                $sheet->getStyle('A8:' . $lastCol . '10')->applyFromArray($headerStyle);
                $sheet
                    ->getStyle('A' . $rowNumber . ':' . $lastCol . $rowNumber)
                    ->getFont()
                    ->setBold(true);
                $sheet->getStyle('A8:' . $lastCol . $rowNumber)->applyFromArray($centerAlign);
            },
        ];
    }
}