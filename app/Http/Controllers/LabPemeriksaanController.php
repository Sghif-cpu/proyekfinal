<?php

namespace App\Http\Controllers;

use App\Models\LabPemeriksaan;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class LabPemeriksaanController extends Controller
{
    // ======================================================
    // INDEX
    // ======================================================
        public function index($rekam_medis_id = null)
        {
        // Jika diberikan rekam_medis_id, tampilkan pemeriksaan untuk rekam tersebut
        if ($rekam_medis_id) {
            $rekam = RekamMedis::with(['pendaftaran.pasien'])
                ->findOrFail($rekam_medis_id);

            $data = LabPemeriksaan::where('rekam_medis_id', $rekam_medis_id)
                ->latest()
                ->get();

            return view('lab.index', compact('rekam', 'data'));
        }

        // Jika tidak ada parameter, tampilkan semua pemeriksaan lab (global)
        $rekam = null;
        $data = LabPemeriksaan::with(['rekamMedis.pendaftaran.pasien'])
            ->latest()
            ->get();

        // Ambil list RekamMedis untuk pilihan di modal (mis. 50 terbaru)
        $rekamMedisList = RekamMedis::with(['pendaftaran.pasien'])
            ->latest()
            ->take(50)
            ->get();

        return view('lab.index', compact('rekam', 'data', 'rekamMedisList'));
        }

    // ======================================================
    // SHOW (DITAMBAHKAN)
    // ======================================================
    public function show($id)
    {
        $data = LabPemeriksaan::with([
            'rekamMedis.pendaftaran.pasien',
            'rekamMedis.pendaftaran.dokter'
        ])->findOrFail($id);

        return view('lab.show', compact('data'));
    }

    // ======================================================
    // CREATE
    // ======================================================
    public function create($rekam_medis_id)
    {
        $rekam = RekamMedis::findOrFail($rekam_medis_id);

        return view('lab.create', compact('rekam'));
    }

    // ======================================================
    // STORE
    // ======================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rekam_medis_id'   => 'required|exists:rekam_medis,id',
            'nama_pemeriksaan' => 'required|string|max:255',
            'hasil'            => 'nullable|string|max:1000',
            'satuan'           => 'nullable|string|max:50',
        ]);

        LabPemeriksaan::create($validated);

        return redirect()
            ->route('lab.index', $request->rekam_medis_id)
            ->with('success', 'Data pemeriksaan lab berhasil ditambahkan');
    }

    // ======================================================
    // EDIT
    // ======================================================
    public function edit($id)
    {
        $data = LabPemeriksaan::findOrFail($id);
        $rekam = $data->rekamMedis;

        return view('lab.edit', compact('data', 'rekam'));
    }

    // ======================================================
    // UPDATE
    // ======================================================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pemeriksaan' => 'required|string|max:255',
            'hasil'            => 'nullable|string|max:1000',
            'satuan'           => 'nullable|string|max:50',
        ]);

        $lab = LabPemeriksaan::findOrFail($id);
        $lab->update($validated);

        return redirect()
            ->route('lab.index', $lab->rekam_medis_id)
            ->with('success', 'Data pemeriksaan lab berhasil diperbarui');
    }

    // ======================================================
    // DELETE
    // ======================================================
    public function destroy($id)
    {
        $lab = LabPemeriksaan::findOrFail($id);

        $rmid = $lab->rekam_medis_id;

        $lab->delete();

        return redirect()
            ->route('lab.index', $rmid)
            ->with('success', 'Pemeriksaan lab berhasil dihapus');
    }
}
