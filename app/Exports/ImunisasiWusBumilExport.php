<?php

namespace App\Exports;

use App\Models\ImunisasiWusBumil;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ImunisasiWusBumilExport implements WithEvents, WithColumnWidths, WithTitle, WithColumnFormatting
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function title(): string
    {
        return 'Data Imunisasi WUS & Bumil';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 20,
            'D' => 8,
            'E' => 10,
            'F' => 20,
            'G' => 30,
            'H' => 20,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $titleStyle = [
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ];
                $posyanduTitleStyle = [
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ];
                $headerStyle = [
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ];
                $allBordersStyle = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ];


                $sheet->mergeCells('A1:H2');
                $sheet->setCellValue('A1', 'Nama-Nama Wus dan Bumil yang Di Imunisasi');
                $sheet->getStyle('A1')->applyFromArray($titleStyle);
                $sheet->getStyle('A1')->getAlignment()->setWrapText(true);

                $rowNumber = 3;

                foreach ($this->data as $posyanduName => $wusBumilGroup) {

                    $sheet->mergeCells('A' . $rowNumber . ':H' . $rowNumber);
                    $sheet->setCellValue('A' . $rowNumber, 'Nama Posyandu: ' . $posyanduName);
                    $sheet->getStyle('A' . $rowNumber)->applyFromArray($posyanduTitleStyle);
                    $rowNumber++;


                    $startHeaderRow = $rowNumber;
                    $headers = ['No', 'Nama Wus/Bumil', 'Nama Suami', 'Umur', 'Hamil Ke', 'Nama Imunisasi', 'Alamat Lengkap', 'NIK'];
                    $sheet->fromArray($headers, null, 'A' . $rowNumber);
                    $sheet->getStyle('A' . $rowNumber . ':H' . $rowNumber)->applyFromArray($headerStyle);
                    $rowNumber++;

                    $nomor = 1;
                    foreach ($wusBumilGroup as $item) {
                        $sheet->setCellValue('A' . $rowNumber, $nomor++);
                        $sheet->setCellValue('B' . $rowNumber, $item->nama_wus_bumil);
                        $sheet->setCellValue('C' . $rowNumber, $item->nama_suami);
                        $sheet->setCellValue('D' . $rowNumber, $item->umur);
                        $sheet->setCellValue('E' . $rowNumber, $item->hamil_ke);
                        $sheet->setCellValue('F' . $rowNumber, $item->jenisImunisasi->nama_imunisasi ?? 'N/A');
                        $sheet->setCellValue('G' . $rowNumber, $item->alamat_lengkap);
                        $sheet->setCellValueExplicit('H' . $rowNumber, $item->nik, DataType::TYPE_STRING);

                        $rowNumber++;
                    }

                    $endDataRow = $rowNumber - 1;
                    if ($endDataRow >= $startHeaderRow) {
                        $sheet->getStyle('A' . $startHeaderRow . ':H' . $endDataRow)->applyFromArray($allBordersStyle);
                    }
                    $rowNumber += 2;
                }
            },
        ];
    }
}
