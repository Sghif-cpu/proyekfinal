<?php

namespace App\Http\Controllers;

use App\Models\LabPemeriksaan;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class LabPemeriksaanController extends Controller
{
    // ============================
    // TAMPILKAN LAB 
    // (BISA TANPA / DENGAN ID)
    // ============================
    public function index($rekam_medis_id = null)
    {
        // Kalau ada ID, tampilkan lab per 1 rekam medis
        if ($rekam_medis_id) {
            $rm = RekamMedis::with(['pendaftaran.pasien', 'lab'])
                ->findOrFail($rekam_medis_id);

            return view('lab.index', compact('rm', 'rekam_medis_id'));
        }

        // Kalau TIDAK ada ID (dari sidebar) → tampilkan daftar RM
        $dataRM = RekamMedis::with('pendaftaran.pasien')
            ->latest()
            ->get();

        return view('lab.index', compact('dataRM', 'rekam_medis_id'));
    }

    // ============================
    // FORM TAMBAH LAB
    // ============================
    public function create($rekam_medis_id)
    {
        $rm = RekamMedis::with('pendaftaran.pasien')
            ->findOrFail($rekam_medis_id);

        return view('lab.create', compact('rm'));
    }

    // ============================
    // SIMPAN LAB
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'rekam_medis_id'    => 'required|exists:rekam_medis,id',
            'nama_pemeriksaan'  => 'required|string|max:100',
            'hasil'              => 'nullable|string|max:100',
            'satuan'             => 'nullable|string|max:50',
        ]);

        LabPemeriksaan::create([
            'rekam_medis_id'   => $request->rekam_medis_id,
            'nama_pemeriksaan' => $request->nama_pemeriksaan,
            'hasil'             => $request->hasil,
            'satuan'            => $request->satuan,
        ]);

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
            'nama_pemeriksaan' => 'required|string|max:100',
            'hasil'             => 'nullable|string|max:100',
            'satuan'            => 'nullable|string|max:50',
        ]);

        $lab = LabPemeriksaan::findOrFail($id);

        $lab->update([
            'nama_pemeriksaan' => $request->nama_pemeriksaan,
            'hasil'             => $request->hasil,
            'satuan'            => $request->satuan,
        ]);

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

        $rekam_medis_id = $lab->rekam_medis_id;

        $lab->delete();

        return redirect()
            ->route('lab.index', $rekam_medis_id)
            ->with('success', 'Pemeriksaan Lab berhasil dihapus');
    }
}
