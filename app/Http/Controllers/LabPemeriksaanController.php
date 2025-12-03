<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabPemeriksaan;
use App\Models\RekamMedis;

class LabPemeriksaanController extends Controller
{
    public function index(Request $request, $rekam_medis_id = null)
    {
        $tanggal_mulai   = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;

        $query = LabPemeriksaan::with(['rekamMedis.pendaftaran.pasien', 'rekamMedis.pendaftaran.dokter']);

        // Jika berdasarkan rekam medis
        if ($rekam_medis_id) {
            $query->where('rekam_medis_id', $rekam_medis_id);
        }

        // Filter tanggal dari created_at
        if ($tanggal_mulai && $tanggal_selesai) {
            $query->whereBetween('created_at', [
                $tanggal_mulai . ' 00:00:00',
                $tanggal_selesai . ' 23:59:59'
            ]);
        }

        $labs = $query->latest()->paginate(10);

        return view('lab.index', compact('labs', 'rekam_medis_id'));
    }

    public function create($rekam_medis_id)
    {
        $rekam = RekamMedis::with(['pendaftaran.pasien', 'pendaftaran.dokter'])
            ->findOrFail($rekam_medis_id);

        return view('lab.create', compact('rekam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rekam_medis_id'   => 'required',
            'nama_pemeriksaan' => 'required',
            'hasil'             => 'nullable',
            'satuan'            => 'nullable'
        ]);

        LabPemeriksaan::create($request->all());

        return redirect()->route('lab.index', $request->rekam_medis_id)
            ->with('success', 'Data lab berhasil disimpan');
    }

    public function edit($id)
    {
        $data = LabPemeriksaan::with(['rekamMedis.pendaftaran.pasien', 'rekamMedis.pendaftaran.dokter'])
            ->findOrFail($id);

        $rekam = $data->rekamMedis;

        return view('lab.edit', compact('data', 'rekam'));
    }

    public function update(Request $request, $id)
    {
        $data = LabPemeriksaan::findOrFail($id);

        $request->validate([
            'nama_pemeriksaan' => 'required',
            'hasil' => 'nullable',
            'satuan' => 'nullable'
        ]);

        $data->update($request->all());

        return redirect()->route('lab.index', $data->rekam_medis_id)
            ->with('success', 'Data lab berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = LabPemeriksaan::findOrFail($id);
        $rekam_medis_id = $data->rekam_medis_id;

        $data->delete();

        return redirect()->route('lab.index', $rekam_medis_id)
            ->with('success', 'Data lab berhasil dihapus');
    }
}
