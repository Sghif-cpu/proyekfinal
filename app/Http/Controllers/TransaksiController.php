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
        $pendaftaran = Pendaftaran::latest()->get();

        return view('transaksi.index', compact('data', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        // Validasi minimal 1 item
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'keterangan.*' => 'nullable|string',
            'harga.*' => 'nullable|numeric'
        ]);

        // Hitung total hanya untuk harga yang valid
        $total = 0;
        foreach ($request->harga as $index => $harga) {
            if (!empty($harga) && !empty($request->keterangan[$index])) {
                $total += $harga;
            }
        }

        // Simpan transaksi utama
        $transaksi = Transaksi::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'total' => $total,
            'status' => 'belum_dibayar'
        ]);

        // Simpan detail transaksi (skip jika kosong)
        foreach ($request->keterangan as $key => $ket) {
            if (!empty($ket) && !empty($request->harga[$key])) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'keterangan' => $ket,
                    'harga' => $request->harga[$key]
                ]);
            }
        }

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dibuat!');
    }

    public function update($id)
    {
        $data = Transaksi::findOrFail($id);
        $data->update(['status' => 'sudah_dibayar']);

        return back()->with('success', 'Pembayaran berhasil!');
    }
}
