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
        $section = $phpWord->addSection();

        // Header
        $section->addText(
            'FORM ANC SESUAI STANDAR',
            ['bold' => true, 'size' => 16],
            ['alignment' => 'center']
        );
        $section->addTextBreak(1);

        // Data Pasien
        $section->addText("No. Rekam medis/Kohort\t: {$ancRecord->rekam_medis}/{$ancRecord->kohort}");
        $section->addText("Nama pasien\t\t: {$ancRecord->nama_pasien}");
        $section->addText("Alamat (sesuai KTP)\t: {$ancRecord->alamat}");
        $section->addText("NIK\t\t\t: {$ancRecord->nik}");
        $section->addText("Petugas\t\t\t: {$ancRecord->petugas}");
        $section->addTextBreak(1);

        // Tabel ANC
        $section->addText('Form ANC', ['bold' => true]);
        $section->addTextBreak(1);

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80
        ]);

        // Header tabel
        $table->addRow();
        $table->addCell(500)->addText('No', ['bold' => true]);
        $table->addCell(4000)->addText('Kontak ke Usia minggu', ['bold' => true]);
        $table->addCell(800)->addText('K1 0-12 minggu', ['bold' => true]);
        $table->addCell(800)->addText('K2 >12-24 minggu', ['bold' => true]);
        $table->addCell(800)->addText('K3 >12-24 minggu', ['bold' => true]);
        $table->addCell(800)->addText('K4 >24 minggu sampai kelahiran', ['bold' => true]);
        $table->addCell(800)->addText('K5 >24 minggu sampai kelahiran', ['bold' => true]);
        $table->addCell(800)->addText('K6 >24 minggu sampai kelahiran', ['bold' => true]);

        // Baris ANC sesuai standar
        $table->addRow();
        $table->addCell()->addText('');
        $table->addCell()->addText('ANC sesuai standar', ['bold' => true]);
        $table->addCell()->addText('');
        $table->addCell()->addText('');
        $table->addCell()->addText('');
        $table->addCell()->addText('');
        $table->addCell()->addText('');
        $table->addCell()->addText('');

        // Baris Sumber
        $table->addRow();
        $table->addCell()->addText('');
        $table->addCell()->addText('Sumber', ['bold' => true]);
        $table->addCell()->addText('');
        $table->addCell()->addText('');
        $table->addCell()->addText('');
        $table->addCell()->addText('');
        $table->addCell()->addText('');
        $table->addCell()->addText('');

        // Data ANC Items
        $ancItems = AncRecord::getAncItems();
        foreach ($ancItems as $no => $item) {
            $table->addRow();
            $table->addCell()->addText($no);
            $table->addCell()->addText($item);

            // Check untuk setiap kunjungan
            foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan) {
                $checked = isset($ancRecord->$kunjungan) &&
                    is_array($ancRecord->$kunjungan) &&
                    in_array($no, $ancRecord->$kunjungan) ? '✓' : '';
                $table->addCell()->addText($checked);
            }
        }

        $section->addTextBreak(1);
        $section->addText('Keterangan:', ['bold' => true]);
        $section->addText('1. Ceklis kolom ANC sesuai standar terlebih dahulu');
        $section->addText('2. Ceklis sesuai dengan pelayanan yang dilakukan');

        $fileName = 'Form_ANC_' . $ancRecord->nama_pasien . '_' . date('Y-m-d') . '.docx';

        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
