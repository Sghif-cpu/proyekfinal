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
        // Ambil semua transaksi + relasinya
        $data = Transaksi::with('pendaftaran')->latest()->get();

        // Ambil data pendaftaran untuk dropdown form kasir
        $pendaftaran = Pendaftaran::latest()->get();

        return view('transaksi.index', compact('data', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $transaksi = Transaksi::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'total' => array_sum($request->harga),
            'status' => 'belum_dibayar'
        ]);

        foreach ($request->keterangan as $key => $value) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'keterangan' => $value,
                'harga' => $request->harga[$key]
            ]);
        }

        return back()->with('success','Transaksi berhasil dibuat');
    }

    public function update($id)
    {
        $data = Transaksi::findOrFail($id);
        $data->update(['status' => 'sudah_dibayar']);
    }
}
