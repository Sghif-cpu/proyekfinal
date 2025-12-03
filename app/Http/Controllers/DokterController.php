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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'poli_id' => 'nullable',
            'sip' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        Dokter::create($request->all());
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
            'sip' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        Dokter::findOrFail($id)->update($request->all());
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
