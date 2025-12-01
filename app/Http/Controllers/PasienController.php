<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Penjamin;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::latest()->paginate(10);
        return view('pasien.index', compact('pasien'));
    }

    public function create()
    {
        // generate No RM otomatis
        $last = Pasien::latest()->first();
        $no_rm = $last ? 'RM'.str_pad(($last->id + 1), 5, '0', STR_PAD_LEFT) : 'RM00001';

        $penjamin = Penjamin::all();

        return view('pasien.create', compact('no_rm','penjamin'));
    }

public function store(Request $request)
{
    $request->validate([
        'no_rm'         => 'required|unique:pasien,no_rm',
        'nik'           => 'required|unique:pasien,nik',
        'nama'          => 'required|string',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'no_hp'         => 'required',
        'alamat'        => 'nullable',
        'penjamin_id'   => 'required|exists:penjamin,id',
    ]);

    Pasien::create([
        'no_rm'         => $request->no_rm,
        'nik'           => $request->nik,
        'nama'          => $request->nama,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'no_hp'         => $request->no_hp,
        'alamat'        => $request->alamat,
        'penjamin_id'   => $request->penjamin_id,
    ]);

    return redirect()
        ->route('pasien.index')
        ->with('success', 'Pasien berhasil ditambahkan');
}

    public function show(Pasien $pasien)
    {
        return view('pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        $penjamin = Penjamin::all();
        return view('pasien.edit', compact('pasien','penjamin'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama'           => 'required|string',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'no_hp'          => 'required',
            'alamat'         => 'nullable',
            'penjamin_id'    => 'required|exists:penjamin,id',
        ]);

        $pasien->update([
            'nama'           => $request->nama,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'no_hp'          => $request->no_hp,
            'alamat'         => $request->alamat,
            'penjamin_id'    => $request->penjamin_id,
        ]);

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien diperbarui');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien dihapus');
    }
}
