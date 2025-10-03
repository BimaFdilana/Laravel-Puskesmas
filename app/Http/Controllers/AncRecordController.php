<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AncRecord;
use App\Exports\IbuHamilExport;

class AncRecordController extends Controller
{
    public function index()
    {
        $records = AncRecord::latest()->paginate(10);
        return view('pages.apps.pustu.ibu_hamil.index', compact('records'));
    }

    public function laporanIndex()
    {
        $records = AncRecord::latest()->paginate(10);
        return view('pages.apps.pustu.ibu_hamil.laporan_ibu_hamil.index', compact('records'));
    }

    public function create()
    {
        $ancItems = AncRecord::getAncItems();
        $kunjunganTypes = AncRecord::getKunjunganTypes();
        return view('pages.apps.pustu.ibu_hamil.create', compact('ancItems', 'kunjunganTypes'));
    }

    public function store(Request $request)
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

        foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan) {
            $validated[$kunjungan] = json_encode($request->input($kunjungan, []));
        }

        AncRecord::create($validated);

        return redirect()->route('anc.index')->with('success', 'Anc Record created successfully');
    }

    public function show(AncRecord $anc)
    {
        foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan) {
            $anc->$kunjungan = json_decode($anc->$kunjungan) ?? [];
        }
        return response()->json($anc);
    }

    public function edit(string $id)
    {
        $ancRecord = AncRecord::findOrFail($id);
        foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan) {
            $ancRecord->$kunjungan = json_decode($ancRecord->$kunjungan ?? '[]', true);
        }
        $ancItems = AncRecord::getAncItems();
        $kunjunganTypes = AncRecord::getKunjunganTypes();

        return view('pages.apps.pustu.ibu_hamil.edit', compact('ancRecord', 'ancItems', 'kunjunganTypes'));
    }

    public function update(Request $request, string $id)
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
        foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan) {
            $validated[$kunjungan] = json_encode($request->input($kunjungan, []));
        }

        try {
            $ancRecord = AncRecord::findOrFail($id);
            $ancRecord->update($validated);
            return redirect()->route('anc.index')->with('success', 'Anc Record updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Anc Record update failed');
        }
    }

    public function destroy(string $id)
    {
        $ancRecord = AncRecord::findOrFail($id);
        $ancRecord->delete();
        return redirect()->route('anc.index')->with('success', 'Data ANC berhasil dihapus!');
    }

    public function exportWord(AncRecord $ancRecord)
    {
        $exporter = new IbuHamilExport($ancRecord);
        $fileDetails = $exporter->export();
        return response()->download($fileDetails['filePath'], $fileDetails['fileName'])->deleteFileAfterSend(true);
    }
}