<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AncRecord;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


class AncRecordController extends Controller
{
    public function index()
    {
        $records = AncRecord::latest()->paginate(10);
        return view('pages.apps.pustu.ibu_hamil.index', compact('records'));
    }

    public function create()
    {
        $ancItems = AncRecord::getAncItems();
        $kunjunganTypes = AncRecord::getKunjunganTypes();
        return view('pages.apps.pustu.ibu_hamil.create', compact('ancItems', 'kunjunganTypes'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'rekam_medis' => 'required|string',
            'kohort' => 'required|string',
            'nama_pasien' => 'required|string',
            'alamat' => 'required|string',
            'nik' => 'required|string',
            'petugas' => 'required|string',
            'k1' => 'required|array',
            'k2' => 'required|array',
            'k3' => 'required|array',
            'k4' => 'required|array',
            'k5' => 'required|array',
            'k6' => 'required|array',
        ]);

        // Ubah array ke JSON jika kolom di DB bertipe JSON
        $validate['k1'] = json_encode($validate['k1']);
        $validate['k2'] = json_encode($validate['k2']);
        $validate['k3'] = json_encode($validate['k3']);
        $validate['k4'] = json_encode($validate['k4']);
        $validate['k5'] = json_encode($validate['k5']);
        $validate['k6'] = json_encode($validate['k6']);

        AncRecord::create($validate);

        return redirect()->route('anc.index')->with('success', 'Anc Record created successfully');
    }


    public function show(AncRecord $ancRecord)
    {
        $ancItems = AncRecord::getAncItems();
        $kunjunganTypes = AncRecord::getKunjunganTypes();
        return view('pages.apps.pustu.ibu_hamil.show', compact('ancRecord', 'ancItems', 'kunjunganTypes'));
    }

    public function edit(AncRecord $ancRecord)
    {
        $ancItems = AncRecord::getAncItems();
        $kunjunganTypes = AncRecord::getKunjunganTypes();
        return view('pages.apps.pustu.ibu_hamil.edit', compact('ancRecord', 'ancItems', 'kunjunganTypes'));
    }

    public function update(Request $request, AncRecord $ancRecord)
    {
        $validated = $request->validate([
            'rekam_medis' => 'required|string',
            'kohort' => 'required|string',
            'nama_pasien' => 'required|string',
            'alamat' => 'required|string',
            'nik' => 'required|string',
            'petugas' => 'required|string',
            'k1' => 'nullable|array',
            'k2' => 'nullable|array',
            'k3' => 'nullable|array',
            'k4' => 'nullable|array',
            'k5' => 'nullable|array',
            'k6' => 'nullable|array',
        ]);

        $ancRecord->update($validated);

        return redirect()->route('anc.index')->with('success', 'Data ANC berhasil diupdate!');
    }

    public function destroy(AncRecord $ancRecord)
    {
        $ancRecord->delete();
        return redirect()->route('anc.index')->with('success', 'Data ANC berhasil dihapus!');
    }

    public function exportWord(AncRecord $ancRecord)
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(10);

        $section = $phpWord->addSection();

        // Header
        $section->addText(
            'FORM ANC SESUAI STANDAR',
            ['bold' => true, 'size' => 14],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );
        $section->addTextBreak(1);

        // Data Pasien
        $tableStyleNoBorder = ['borderSize' => 0, 'borderColor' => 'FFFFFF', 'cellMargin' => 0];
        $patientTable = $section->addTable($tableStyleNoBorder);
        $rowHeight = 400;

        $patientTable->addRow($rowHeight);
        $patientTable->addCell(3000)->addText("No. Rekam medis/Kohort");
        $patientTable->addCell(300)->addText(":");
        $patientTable->addCell(6000)->addText("{$ancRecord->rekam_medis}/{$ancRecord->kohort}");

        $patientTable->addRow($rowHeight);
        $patientTable->addCell(3000)->addText("Nama pasien");
        $patientTable->addCell(300)->addText(":");
        $patientTable->addCell(6000)->addText($ancRecord->nama_pasien);

        $patientTable->addRow($rowHeight);
        $patientTable->addCell(3000)->addText("Alamat (sesuai KTP)");
        $patientTable->addCell(300)->addText(":");
        $patientTable->addCell(6000)->addText($ancRecord->alamat);

        $patientTable->addRow($rowHeight);
        $patientTable->addCell(3000)->addText("NIK");
        $patientTable->addCell(300)->addText(":");
        $patientTable->addCell(6000)->addText($ancRecord->nik);

        $patientTable->addRow($rowHeight);
        $patientTable->addCell(3000)->addText("Petugas");
        $patientTable->addCell(300)->addText(":");
        $patientTable->addCell(6000)->addText($ancRecord->petugas);

        $section->addTextBreak(2);

        // Tabel ANC Kompleks
        $tableStyle = ['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80];
        $boldStyle = ['bold' => true];
        $centerAligned = ['align' => 'center'];
        $boldCentered = ['bold' => true, 'align' => 'center'];

        $cellVCentered = ['valign' => 'center'];
        $cellRowSpan = ['vMerge' => 'continue', 'valign' => 'center'];

        $table = $section->addTable($tableStyle);
        $table->setWidth(10000);

        $colWidths = [
            'No'        => 600,
            'Kontak'    => 3000,
            'K1'        => 800,
            'K2'        => 800,
            'K3'        => 800,
            'K4'        => 800,
            'K5'        => 800,
            'K6'        => 800,
        ];

        // --- BARIS 1 ---
        $table->addRow();
        $cell1_1 = $table->addCell($colWidths['No'], ['vMerge' => 'restart', 'valign' => 'center']);
        $cell1_1->addText('No', $boldStyle, $centerAligned);

        $table->addCell($colWidths['Kontak'])->addText('Kontak ke', $boldStyle, $centerAligned);
        $table->addCell($colWidths['K1'])->addText('K1', $boldStyle, $centerAligned);
        $table->addCell($colWidths['K2'])->addText('K2', $boldStyle, $centerAligned);
        $table->addCell($colWidths['K3'])->addText('K3', $boldStyle, $centerAligned);
        $table->addCell($colWidths['K4'])->addText('K4', $boldStyle, $centerAligned);
        $table->addCell($colWidths['K5'])->addText('K5', $boldStyle, $centerAligned);
        $table->addCell($colWidths['K6'])->addText('K6', $boldStyle, $centerAligned);

        // --- BARIS 2 ---
        $table->addRow();
        $table->addCell(null, $cellRowSpan);
        $cell2_2 = $table->addCell($colWidths['Kontak'], ['vMerge' => 'restart', 'valign' => 'center']);
        $cell2_2->addText('Usia minggu', $boldCentered, $centerAligned);
        $cell2_3 = $table->addCell($colWidths['K1'], ['vMerge' => 'restart', 'valign' => 'center']);
        $cell2_3->addText('0-12 Minggu', $boldCentered, $centerAligned);
        $cell2_4 = $table->addCell($colWidths['K2'] + $colWidths['K3'], ['gridSpan' => 2, 'vMerge' => 'restart', 'valign' => 'center']);
        $cell2_4->addText('>12-24 Minggu', $boldCentered, $centerAligned);
        $cell2_6 = $table->addCell($colWidths['K4'] + $colWidths['K5'] + $colWidths['K6'], ['gridSpan' => 3, 'vMerge' => 'restart', 'valign' => 'center']);
        $cell2_6->addText('> 24 Minggu Sampai Kelahiran', $boldCentered, $centerAligned);

        // --- BARIS 3 ---
        $table->addRow();
        $table->addCell(null, $cellRowSpan);
        $table->addCell(null, $cellRowSpan);
        $table->addCell(null, $cellRowSpan);
        $table->addCell(null, ['gridSpan' => 2, 'vMerge' => 'continue']);
        $table->addCell(null, ['gridSpan' => 3, 'vMerge' => 'continue']);

        // --- BARIS 4 ---
        $table->addRow();
        $table->addCell(null, $cellRowSpan);
        $table->addCell($colWidths['Kontak'])->addText('ANC sesuai standart', $boldStyle);
        $table->addCell($colWidths['K1']);
        $table->addCell($colWidths['K2']);
        $table->addCell($colWidths['K3']);
        $table->addCell($colWidths['K4']);
        $table->addCell($colWidths['K5']);
        $table->addCell($colWidths['K6']);

        // --- BARIS 5 ---
        $table->addRow();
        $table->addCell(null, $cellRowSpan);
        $table->addCell($colWidths['Kontak'])->addText('Sumber');
        $table->addCell($colWidths['K1']);
        $table->addCell($colWidths['K2']);
        $table->addCell($colWidths['K3']);
        $table->addCell($colWidths['K4']);
        $table->addCell($colWidths['K5']);
        $table->addCell($colWidths['K6']);

        // Data ANC Items
        $ancItems = \App\Models\AncRecord::getAncItems(); // Gunakan path lengkap ke model
        foreach ($ancItems as $no => $item) {
            $table->addRow();
            $table->addCell($colWidths['No'])->addText($no);
            $table->addCell($colWidths['Kontak'])->addText($item);

            // ========================================================= //
            // ========== INI BAGIAN YANG DIPERBAIKI UTAMA ============= //
            foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan) {
                // Decode string JSON dari database menjadi array PHP
                $checkedItems = json_decode($ancRecord->$kunjungan);

                // Periksa apakah hasil decode adalah array dan apakah nomor item ($no) ada di dalam array
                $checked = (is_array($checkedItems) && in_array($no, $checkedItems)) ? '✓' : '';

                // Tambahkan sel dengan hasil (checklist atau kosong)
                $table->addCell($colWidths[strtoupper($kunjungan)])->addText($checked, null, $centerAligned);
            }
            // ========================================================= //
            // ========================================================= //
        }

        $section->addTextBreak(1);
        $section->addText('Keterangan:', ['bold' => true]);
        $section->addTextBreak(1);
        $section->addText('1. Ceklis kolom ANC sesuai standar terlebih dahulu');
        $section->addText('2. Ceklis sesuai dengan pelayanan yang dilakukan');

        // Penyimpanan File
        $fileName = 'Form_ANC_' . str_replace(' ', '_', $ancRecord->nama_pasien) . '_' . date('Y-m-d') . '.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}