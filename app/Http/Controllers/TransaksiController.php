<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::with(['pendaftaran.pasien'])->latest()->get();
        return view('transaksi.index', compact('data'));
    }

    public function create()
    {
        $pendaftaran = Pendaftaran::doesntHave('transaksi')->with('pasien')->get();
        return view('transaksi.create', compact('pendaftaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'keterangan.*' => 'required|string',
            'harga.*' => 'required|numeric|min:1',
        ]);

        // Fix error foreach null
        if (!is_array($request->keterangan) || !is_array($request->harga)) {
            return back()->with('error', 'Detail transaksi tidak boleh kosong!');
        }

        $transaksi = Transaksi::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'total' => array_sum($request->harga),
            'status' => 'belum_dibayar',
        ]);

        foreach ($request->keterangan as $key => $value) {
            if ($value && isset($request->harga[$key])) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'keterangan' => $value,
                    'harga' => $request->harga[$key],
                ]);
            }
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['detail', 'pendaftaran.pasien'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id);
        $pendaftaran = Pendaftaran::with('pasien')->get();

        return view('transaksi.edit', compact('transaksi', 'pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'keterangan.*' => 'required|string',
            'harga.*' => 'required|numeric|min:1',
        ]);

        // Fix error foreach null
        if (!is_array($request->keterangan) || !is_array($request->harga)) {
            return back()->with('error', 'Detail transaksi tidak boleh kosong!');
        }

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'total' => array_sum($request->harga),
        ]);

        // Hapus detail lama
        TransaksiDetail::where('transaksi_id', $id)->delete();

        // Tambah detail baru
        foreach ($request->keterangan as $key => $value) {
            if ($value && isset($request->harga[$key])) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'keterangan' => $value,
                    'harga' => $request->harga[$key],
                ]);
            }
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        TransaksiDetail::where('transaksi_id', $id)->delete();
        $transaksi->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }

    public function bayar($id)
    {
        Transaksi::where('id', $id)->update(['status' => 'sudah_dibayar']);

        return back()->with('success', 'Transaksi berhasil dibayar.');
    }
}
