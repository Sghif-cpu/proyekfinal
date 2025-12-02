<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Penjamin;
use App\Models\Poli;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? date('Y-m-d');

        $pendaftaran = Pendaftaran::with(['pasien','dokter','penjamin','poli'])
            ->whereDate('tanggal_daftar', $tanggal)
            ->orderBy('no_antrian', 'asc')
            ->paginate(10);

        return view('pendaftaran.index', compact('pendaftaran','tanggal'));
    }

    public function create()
    {
        $pasien   = Pasien::all();
        $dokter   = Dokter::all();
        $penjamin = Penjamin::all();
        $poli     = Poli::all();

        // Auto reset nomor antrian harian
        $hariIni = Carbon::today();
        $lastAntrian = Pendaftaran::whereDate('tanggal_daftar', $hariIni)->max('no_antrian');
        $no_antrian = $lastAntrian ? $lastAntrian + 1 : 1;

        return view('pendaftaran.create', compact('pasien','dokter','penjamin','poli','no_antrian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id'    => 'required|exists:pasien,id',
            'poli_id'      => 'required|exists:poli,id',
            'dokter_id'    => 'required|exists:dokter,id',
            'penjamin_id'  => 'required|exists:penjamin,id',
            'keluhan'      => 'nullable|string',
        ]);

        $hariIni = Carbon::today();

        // Auto nomor antrian
        $lastAntrian = Pendaftaran::whereDate('tanggal_daftar', $hariIni)->max('no_antrian');
        $no_antrian = $lastAntrian ? $lastAntrian + 1 : 1;

        $pendaftaran = Pendaftaran::create([
            'pasien_id'      => $request->pasien_id,
            'poli_id'        => $request->poli_id,
            'dokter_id'      => $request->dokter_id,
            'penjamin_id'    => $request->penjamin_id,
            'no_antrian'     => $no_antrian,
            'tanggal_daftar' => $hariIni,
            'status'         => 'Terdaftar',
            'keluhan'        => $request->keluhan
        ]);

        return redirect()->route('pendaftaran.cetak', $pendaftaran->id)
            ->with('success', 'Pendaftaran berhasil dibuat!');
    }

    public function show(Pendaftaran $pendaftaran)
    {
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        $pasien   = Pasien::all();
        $dokter   = Dokter::all();
        $penjamin = Penjamin::all();
        $poli     = Poli::all();

        return view('pendaftaran.edit', compact(
            'pendaftaran','pasien','dokter','penjamin','poli'
        ));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'dokter_id'   => 'required|exists:dokter,id',
            'penjamin_id' => 'required|exists:penjamin,id',
            'status'      => 'required|in:Terdaftar,Dipanggil,Selesai',
            'keluhan'     => 'nullable|string'
        ]);

        $pendaftaran->update([
            'dokter_id'   => $request->dokter_id,
            'penjamin_id' => $request->penjamin_id,
            'status'      => $request->status,
            'keluhan'     => $request->keluhan
        ]);

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil diperbarui');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')
            ->with('success','Data pendaftaran berhasil dihapus');
    }

    public function cetak($id)
    {
        $pendaftaran = Pendaftaran::with(['pasien','dokter','penjamin','poli'])->findOrFail($id);

        $pdf = Pdf::loadView('pendaftaran.cetak', compact('pendaftaran'))
            ->setPaper('A5', 'portrait');

        return $pdf->stream('antrian-'.$pendaftaran->no_antrian.'.pdf');
    }
}
