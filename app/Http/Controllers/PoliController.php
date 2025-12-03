<?php
namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    // Menampilkan daftar poli
    public function index()
    {
        $data = Poli::all();
        return view('poli.index', compact('data'));
    }

    // Menampilkan form tambah poli
    public function create()
    {
        return view('poli.create');
    }

    // Menyimpan data poli baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Poli::create($request->all());
        return redirect()->route('poli.index')->with('success','Poli ditambahkan');
    }

    // Menampilkan detail poli
    public function show($id)
    {
        $poli = Poli::findOrFail($id);
        return view('poli.show', compact('poli'));
    }

    // Menampilkan form edit poli
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('poli.edit', compact('poli'));
    }

    // Update data poli
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($request->all());

        return redirect()->route('poli.index')->with('success','Poli diperbarui');
    }

    // Hapus poli
    public function destroy($id)
    {
        Poli::findOrFail($id)->delete();
        return redirect()->route('poli.index')->with('success','Poli dihapus');
    }
}
