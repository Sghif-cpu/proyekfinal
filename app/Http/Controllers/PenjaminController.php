<?php

namespace App\Http\Controllers;

use App\Models\Penjamin;
use Illuminate\Http\Request;

class PenjaminController extends Controller
{
    public function index()
    {
        $penjamin = Penjamin::all();
        return view('penjamin.index', compact('penjamin'));
    }

    public function create()
    {
        return view('penjamin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penjamin' => 'required',
            'tipe' => 'required',
            'keterangan' => 'nullable'
        ]);

        Penjamin::create($request->all());

        return redirect()->route('penjamin.index')
                         ->with('success', 'Data Penjamin berhasil ditambahkan.');
    }

    public function show(Penjamin $penjamin)
    {
        return view('penjamin.show', compact('penjamin'));
    }

    public function edit(Penjamin $penjamin)
    {
        return view('penjamin.edit', compact('penjamin'));
    }

    public function update(Request $request, Penjamin $penjamin)
    {
        $request->validate([
            'nama_penjamin' => 'required',
            'tipe' => 'required',
            'keterangan' => 'nullable'
        ]);

        $penjamin->update($request->all());

        return redirect()->route('penjamin.index')
                         ->with('success', 'Data Penjamin berhasil diperbarui.');
    }

    public function destroy(Penjamin $penjamin)
    {
        $penjamin->delete();

        return redirect()->route('penjamin.index')
                         ->with('success', 'Data Penjamin berhasil dihapus.');
    }
}
