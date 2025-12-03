<?php

namespace App\Http\Controllers;

use App\Models\LabPemeriksaan;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class LabPemeriksaanController extends Controller
{
    // ============================
    // TAMPILKAN LAB PER REKAM MEDIS
    // ============================
    public function index($rekamMedisId)
    {
        $rm = RekamMedis::with(['pendaftaran.pasien', 'lab'])
            ->findOrFail($rekamMedisId);

        return view('lab.index', compact('rm'));
    }

    // ============================
    // FORM TAMBAH LAB
    // ============================
    public function create($rekamMedisId)
    {
        $rm = RekamMedis::with('pendaftaran.pasien')
            ->findOrFail($rekamMedisId);

        return view('lab.create', compact('rekam'));
    }

    // ======================================================
    // STORE
    // ======================================================
    public function store(Request $request)
    {
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'nama_pemeriksaan' => 'required|string',
            'hasil' => 'nullable|string',
            'satuan' => 'nullable|string',
        ]);

        LabPemeriksaan::create($request->all());

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
        $request->validate([
            'nama_pemeriksaan' => 'required|string',
            'hasil' => 'nullable|string',
            'satuan' => 'nullable|string',
        ]);

        $lab = LabPemeriksaan::findOrFail($id);
        $lab->update($request->only('nama_pemeriksaan', 'hasil', 'satuan'));

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
        $rekamMedisId = $lab->rekam_medis_id;

        $lab->delete();

        return redirect()
            ->route('lab.index', $rekamMedisId)
            ->with('success', 'Pemeriksaan Lab berhasil dihapus');
    }
}
