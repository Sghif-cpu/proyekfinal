<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_obat' => 'required|unique:obat',
            'nama_obat' => 'required',
            'kategori_obat' => 'required',
            'aturan_pakai' => 'required',
        
        ]);

        Obat::create($request->all());

        return redirect()->route('obat.index')->with('success', 'Data Obat Berhasil Ditambahkan');
    }
}
