<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $data = Poli::all();
        return view('poli.index', compact('data'));
    }

    public function create()
    {
        return view('poli.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        Poli::create($request->all());

        return redirect()->route('poli.index')->with('success','Data poli berhasil ditambahkan');
    }

    public function show($id)
    {
        $poli = Poli::findOrFail($id);
        return view('poli.show', compact('poli'));
    }

    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('poli.edit', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($request->all());

        return redirect()->route('poli.index')->with('success','Data poli berhasil diperbarui');
    }

    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('poli.index')->with('success','Data poli berhasil dihapus');
    }
}
