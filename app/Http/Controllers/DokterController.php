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
        $polis = Poli::all();
        return view('dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'poli_id' => 'required|exists:polis,id',
            'sip' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);
        Dokter::create($request->all());
        return redirect()->route('dokter.index')->with('success','Dokter ditambahkan');
    }

    public function show($id)
    {
        $dokter = Dokter::with('poli')->findOrFail($id);
        return view('dokter.show', compact('dokter'));
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $polis = Poli::all();
        return view('dokter.edit', compact('dokter','polis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'poli_id' => 'required|exists:polis,id',
            'sip' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);
        $dokter = Dokter::findOrFail($id);
        $dokter->update($request->all());
        return redirect()->route('dokter.index')->with('success','Data dokter diperbarui');
    }

    public function destroy($id)
    {
        Dokter::findOrFail($id)->delete();
        return redirect()->route('dokter.index')->with('success','Dokter dihapus');
    }
}
