<?php

namespace App\Exports;

use App\Models\AncRecord;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings; // Impor Settings
use PhpOffice\PhpWord\SimpleType\Jc;

class IbuHamilExport
{
    /**
     * @var AncRecord
     */
    protected $ancRecord;

    /**
     * @var string
     */
    protected $format;

    /**
     * Menerima data record dan format yang akan diekspor.
     *
     * @param AncRecord $ancRecord
     * @param string $format ('word' atau 'pdf')
     */
    public function __construct(AncRecord $ancRecord, string $format = 'word')
    {
        $this->ancRecord = $ancRecord;
        $this->format = $format;
    }

    /**
     * Fungsi utama untuk menghasilkan file Word atau PDF.
     *
     * @return array
     */
    public function export(): array
    {
        // Konfigurasi PDF Renderer (DomPDF) jika formatnya PDF
        if ($this->format === 'pdf') {
            // Pastikan path ke vendor dompdf benar
            $domPdfPath = base_path('vendor/dompdf/dompdf');
            if (is_dir($domPdfPath)) {
                Settings::setPdfRendererPath($domPdfPath);
                Settings::setPdfRendererName('DomPDF');
            } else {
                // Handle error jika DomPDF tidak ditemukan
                throw new \Exception("DomPDF not found. Please run 'composer require dompdf/dompdf'");
            }
        }

        $phpWord = new PhpWord();

        // --- MENGEMBALIKAN FONT DEFAULT KE TIMES NEW ROMAN ---
        // Set default font (akan berlaku untuk Word dan PDF)
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(10);
        // --- AKHIR PERUBAHAN ---


        $section = $phpWord->addSection();

        // Header
        $section->addText('FORM ANC SESUAI STANDAR', ['bold' => true, 'size' => 14], ['alignment' => Jc::CENTER]);
        $section->addTextBreak(1);

        // Data Pasien (Kondisional berdasarkan format)
        if ($this->format === 'pdf') {
            // Versi PDF: Teks biasa sesuai permintaan
            $section->addText("No. Rekam medis/Kohort : {$this->ancRecord->rekam_medis}/{$this->ancRecord->kohort}");
            $section->addText("Nama pasien : {$this->ancRecord->nama_pasien}");
            $section->addText("Alamat (sesuai KTP) : {$this->ancRecord->alamat}");
            $section->addText("NIK : {$this->ancRecord->nik}");
            $section->addText("Petugas : {$this->ancRecord->petugas}");
        } else {
            // Versi Word: Tetap pakai tabel (lebih rapi)
            $tableStyleNoBorder = ['borderSize' => 0, 'borderColor' => 'FFFFFF', 'cellMargin' => 0];
            $patientTable = $section->addTable($tableStyleNoBorder);
            $rowHeight = 400;

            $patientTable->addRow($rowHeight);
            $patientTable->addCell(3000)->addText('No. Rekam medis/Kohort');
            $patientTable->addCell(300)->addText(':');
            $patientTable->addCell(6000)->addText("{$this->ancRecord->rekam_medis}/{$this->ancRecord->kohort}");

            $patientTable->addRow($rowHeight);
            $patientTable->addCell(3000)->addText('Nama pasien');
            $patientTable->addCell(300)->addText(':');
            $patientTable->addCell(6000)->addText($this->ancRecord->nama_pasien);

            $patientTable->addRow($rowHeight);
            $patientTable->addCell(3000)->addText('Alamat (sesuai KTP)');
            $patientTable->addCell(300)->addText(':');
            $patientTable->addCell(6000)->addText($this->ancRecord->alamat);

            $patientTable->addRow($rowHeight);
            $patientTable->addCell(3000)->addText('NIK');
            $patientTable->addCell(300)->addText(':');
            $patientTable->addCell(6000)->addText($this->ancRecord->nik);

            $patientTable->addRow($rowHeight);
            $patientTable->addCell(3000)->addText('Petugas');
            $patientTable->addCell(300)->addText(':');
            $patientTable->addCell(6000)->addText($this->ancRecord->petugas);
        }

        $section->addTextBreak(2);

        // Tabel ANC Kompleks
        $tableStyle = ['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80];
        $boldCentered = ['bold' => true, 'align' => 'center'];
        $centerAligned = ['align' => 'center'];
        $cellRowSpan = ['vMerge' => 'continue', 'valign' => 'center'];

        $table = $section->addTable($tableStyle);
        $table->setWidth(10000); // Lebar tabel dalam twips

        $colWidths = [
            'No' => 600,
            'Kontak' => 3000,
            'K1' => 800,
            'K2' => 800,
            'K3' => 800,
            'K4' => 800,
            'K5' => 800,
            'K6' => 800,
        ];

        // --- Header Tabel ---
        $table->addRow();
        $table->addCell($colWidths['No'], ['vMerge' => 'restart', 'valign' => 'center'])->addText('No', $boldCentered);
        $table->addCell($colWidths['Kontak'])->addText('Kontak ke', $boldCentered);
        for ($i = 1; $i <= 6; $i++) {
            $table->addCell($colWidths['K' . $i])->addText('K' . $i, $boldCentered);
        }

        $table->addRow();
        $table->addCell(null, $cellRowSpan);
        $table->addCell($colWidths['Kontak'], ['vMerge' => 'restart', 'valign' => 'center'])->addText('Usia minggu', $boldCentered);
        $table->addCell($colWidths['K1'], ['vMerge' => 'restart', 'valign' => 'center'])->addText('0-12 Minggu', $boldCentered);
        $table->addCell($colWidths['K2'] + $colWidths['K3'], ['gridSpan' => 2, 'vMerge' => 'restart', 'valign' => 'center'])->addText('>12-24 Minggu', $boldCentered);
        $table->addCell($colWidths['K4'] + $colWidths['K5'] + $colWidths['K6'], ['gridSpan' => 3, 'vMerge' => 'restart', 'valign' => 'center'])->addText('> 24 Minggu Sampai Kelahiran', $boldCentered);

        // Baris kosong untuk melengkapi merge
        $table->addRow();
        $table->addCell(null, $cellRowSpan);
        $table->addCell(null, $cellRowSpan);
        $table->addCell(null, $cellRowSpan);
        $table->addCell(null, ['gridSpan' => 2, 'vMerge' => 'continue']);
        $table->addCell(null, ['gridSpan' => 3, 'vMerge' => 'continue']);

        // --- Data ANC Items ---
        $ancItems = AncRecord::getAncItems();
        foreach ($ancItems as $no => $item) {
            $table->addRow();
            $table->addCell($colWidths['No'])->addText($no);
            $table->addCell($colWidths['Kontak'])->addText($item);

            foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan) {
                $checkedItems = json_decode($this->ancRecord->$kunjungan);

                $checked = is_array($checkedItems) && in_array((string) $no, $checkedItems, true) ? '✓' : '';

                // --- PERUBAHAN FONT HANYA UNTUK CENTANG DI PDF ---
                $fontStyle = null; // Default, akan pakai Times New Roman
                $cellStyle = $centerAligned;

                // Jika formatnya PDF dan ada centang, ganti font *hanya* untuk teks ini
                if ($this->format === 'pdf' && $checked === '✓') {
                    $fontStyle = ['name' => 'DejaVu Sans'];
                }

                $table->addCell($colWidths[strtoupper($kunjungan)])->addText($checked, $fontStyle, $cellStyle);
                // --- AKHIR PERUBAHAN ---
            }
        }

        $section->addTextBreak(1);
        $section->addText('Keterangan:', ['bold' => true]);
        $section->addTextBreak(1);
        $section->addText('1. Ceklis kolom ANC sesuai standar terlebih dahulu');
        $section->addText('2. Ceklis sesuai dengan pelayanan yang dilakukan');

        // Tentukan writer dan nama file berdasarkan format
        $writerName = ($this->format === 'pdf') ? 'PDF' : 'Word2007';
        $fileExtension = ($this->format === 'pdf') ? '.pdf' : '.docx';

        $fileName = 'Form_ANC_' . str_replace(' ', '_', $this->ancRecord->nama_pasien) . '_' . date('Y-m-d') . $fileExtension;

        // Simpan file ke direktori temporary dan kembalikan path & nama filenya
        $objWriter = IOFactory::createWriter($phpWord, $writerName);
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
        $objWriter->save($tempFile);

        return [
            'filePath' => $tempFile,
            'fileName' => $fileName,
        ];
    }
}
