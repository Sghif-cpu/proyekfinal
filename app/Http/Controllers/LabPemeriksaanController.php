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

        return view('lab.create', compact('rm'));
    }

    // ============================
    // SIMPAN LAB
    // ============================
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
            ->with('success', 'Pemeriksaan Lab berhasil ditambahkan');
    }

    // ============================
    // FORM EDIT LAB
    // ============================
    public function edit($id)
    {
        $lab = LabPemeriksaan::findOrFail($id);

        return view('lab.edit', compact('lab'));
    }

    // ============================
    // UPDATE LAB
    // ============================
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
            ->with('success', 'Data Lab berhasil diperbarui');
    }

    // ============================
    // HAPUS LAB
    // ============================
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
