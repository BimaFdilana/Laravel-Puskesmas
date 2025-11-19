<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class LaporanImunisasiExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $data;
    protected $bulan;
    protected $tahun;

    public function __construct(array $data, $bulan, $tahun)
    {
        $this->data = $data;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        return view('pages.apps.pustu.imunisasi.exports.laporan_imunisasi', [
            'reportData' => $this->data,
            'namaBulan' => Carbon::create()->month($this->bulan)->translatedFormat('F'),
            'tahun' => $this->tahun
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $lastRow = 9 + count($this->data);

                $cellRange = 'A6:AF' . $lastRow;
                $event->sheet->getDelegate()->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $headerRange = 'A5:AF7';
                $event->sheet->getDelegate()->getStyle($headerRange)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle($headerRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($headerRange)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $dataStartRow = 8;
                $dataRange = 'C' . $dataStartRow . ':AF' . $lastRow;
                $event->sheet->getDelegate()->getStyle($dataRange)
                    ->getNumberFormat()
                    ->setFormatCode('#,##0;-#,##0;;@');
            },
        ];
    }
}