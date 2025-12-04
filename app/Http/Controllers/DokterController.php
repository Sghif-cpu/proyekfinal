<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $data = Dokter::with('poli')->get();
        return view('dokter.index', compact('data'));
    }

    public function create()
    {
        $poli = Poli::all();
        return view('dokter.create', compact('poli'));
    }

    /**
     * 🔥 Generate nomor SIP otomatis
     * Format: SIP0001, SIP0002, SIP0003, dst.
     */
    private function generateSip()
    {
        // Ambil SIP terakhir
        $last = Dokter::orderBy('id', 'DESC')->value('sip');

        if (!$last) {
            return "SIP0001";
        }

        // Ambil angka di belakang "SIP"
        $number = intval(substr($last, 3));

        // Increment + format ulang
        $newNumber = str_pad($number + 1, 4, '0', STR_PAD_LEFT);

        return "SIP" . $newNumber;
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'poli_id' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        // 🔥 generate SIP otomatis
        $sipBaru = $this->generateSip();

        Dokter::create([
            'nama' => $request->nama,
            'poli_id' => $request->poli_id,
            'no_hp' => $request->no_hp,
            'sip' => $sipBaru, // SIP otomatis
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan!');
    }

    public function show($id)
    {
        $dokter = Dokter::with('poli')->findOrFail($id);
        return view('dokter.show', compact('dokter'));
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $poli = Poli::all();
        return view('dokter.edit', compact('dokter', 'poli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'poli_id' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        Dokter::findOrFail($id)->update([
            'nama' => $request->nama,
            'poli_id' => $request->poli_id,
            'no_hp' => $request->no_hp,
            // ❗ SIP tidak diupdate (karena nomor tetap)
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Dokter::findOrFail($id)->delete();
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus!');
    }

    // 🔥 AJAX FILTER DOKTER BERDASARKAN POLI
    public function getByPoli($poli_id)
    {
        $dokter = Dokter::where('poli_id', $poli_id)->get();
        return response()->json($dokter);
    }
}
