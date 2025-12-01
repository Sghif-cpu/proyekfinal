<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    // =====================================================
    // 1. TAMPILKAN SEMUA REKAM MEDIS
    // =====================================================
    public function index()
    {
        $data = RekamMedis::with([
                'pendaftaran.pasien',
                'pendaftaran.dokter'
            ])
            ->latest()
            ->get();

        return view('rekam_medis.index', compact('data'));
    }

    // =====================================================
    // 2. FORM PEMBUATAN REKAM MEDIS (Pemeriksaan Baru)
    // =====================================================
    public function create(Request $request)
    {
        // Validasi & ambil data pendaftaran
        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])
            ->findOrFail($request->pendaftaran_id);

        return view('rekam_medis.create', compact('pendaftaran'));
    }

    // =====================================================
    // 3. SIMPAN DATA PEMERIKSAAN BARU
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'diagnosa'       => 'nullable|string',
            'tindakan'       => 'nullable|string',
            'catatan'        => 'nullable|string',
        ]);

        RekamMedis::create($request->all());

        return redirect()
            ->route('rekam-medis.index')
            ->with('success', 'Pemeriksaan berhasil disimpan');
    }

    // =====================================================
    // 4. DETAIL REKAM MEDIS
    // =====================================================
    public function show($id)
    {
        $data = RekamMedis::with([
                'pendaftaran.pasien',
                'pendaftaran.dokter',
                'resep'
            ])
            ->findOrFail($id);

        return view('rekam_medis.show', compact('data'));
    }

    // =====================================================
    // 5. FORM EDIT PEMERIKSAAN
    // =====================================================
    public function edit($id)
    {
        $data = RekamMedis::with([
                'pendaftaran.pasien',
                'pendaftaran.dokter'
            ])
            ->findOrFail($id);

        return view('rekam_medis.edit', compact('data'));
    }

    // =====================================================
    // 6. UPDATE PEMERIKSAAN
    // =====================================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'diagnosa' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'catatan'  => 'nullable|string',
        ]);

        $rm = RekamMedis::findOrFail($id);

        $rm->update(
            $request->only('diagnosa', 'tindakan', 'catatan')
        );

        return redirect()
            ->route('rekam-medis.show', $id)
            ->with('success', 'Data pemeriksaan diperbarui');
    }

    // =====================================================
    // 7. HAPUS REKAM MEDIS
    // =====================================================
    public function destroy($id)
    {
        RekamMedis::findOrFail($id)->delete();

        return redirect()
            ->route('rekam-medis.index')
            ->with('success', 'Rekam medis berhasil dihapus');
    }
}
