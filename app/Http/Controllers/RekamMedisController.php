<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RekamMedisController extends Controller
{
    // =====================================================
    // 1. LIST / INDEX
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
    // 2. FORM CREATE
    // =====================================================
    public function create()
    {
        // Semua pendaftaran pasien
        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])
            ->latest()
            ->get();

        return view('rekam_medis.create', compact('pendaftaran'));
    }


    // =====================================================
    // 3. SIMPAN PEMERIKSAAN
    // =====================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'diagnosa'       => 'nullable|string',
            'tindakan'       => 'nullable|string',
            'catatan'        => 'nullable|string',
        ]);

        RekamMedis::create($validated);

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
                'resep',
            ])
            ->findOrFail($id);

        return view('rekam_medis.show', compact('data'));
    }


    // =====================================================
    // 5. FORM EDIT
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
    // 6. UPDATE DATA
    // =====================================================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'diagnosa' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'catatan'  => 'nullable|string',
        ]);

        $rekam = RekamMedis::findOrFail($id);
        $rekam->update($validated);

        return redirect()
            ->route('rekam-medis.show', $id)
            ->with('success', 'Data pemeriksaan diperbarui');
    }


    // =====================================================
    // 7. HAPUS DATA
    // =====================================================
    public function destroy($id)
    {
        RekamMedis::findOrFail($id)->delete();

        return redirect()
            ->route('rekam-medis.index')
            ->with('success', 'Rekam medis berhasil dihapus');
    }


    // =====================================================
    // 8. CETAK PDF
    // =====================================================
    public function print($id)
    {
        $data = RekamMedis::with([
                'pendaftaran.pasien',
                'pendaftaran.dokter',
                'resep'
            ])
            ->findOrFail($id);

        $pdf = Pdf::loadView('rekam_medis.print', compact('data'))
                ->setPaper('A4', 'portrait');

        return $pdf->stream("Rekam-Medis-{$data->id}.pdf");
    }
}
