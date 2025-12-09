<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'nama_obat' => 'required',
            'satuan'    => 'required',
            'stok'      => 'required|integer|min:0',
            'harga'     => 'required|numeric|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'satuan'    => $request->satuan,
            'stok'      => $request->stok,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('obat.index')->with('success', 'Data Obat Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'satuan'    => 'required',
            'stok'      => 'required|integer|min:0',
            'harga'     => 'required|numeric|min:0',
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'satuan'    => $request->satuan,
            'stok'      => $request->stok,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('obat.index')->with('success', 'Data Obat Berhasil Diperbarui');
    }

    public function show($id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.show', compact('obat'));
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Data Obat Berhasil Dihapus');
    }

    // ==========================
    //     FUNGSI CETAK PDF
    // ==========================
    public function cetak()
    {
        $obat = Obat::all();

        $pdf = Pdf::loadView('obat.cetak', compact('obat'))
                    ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-obat.pdf');
    }
}
