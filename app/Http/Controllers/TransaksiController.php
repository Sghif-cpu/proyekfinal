<?php  
namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::with('pendaftaran')->latest()->get();
        return view('transaksi.index', compact('data'));
    }

    public function store(Request $request)
    {
        Transaksi::create($request->all());
        return back()->with('success','Transaksi dibuat');
    }

    public function update($id)
    {
        $data = Transaksi::findOrFail($id);
        $data->update(['status_bayar' => 'Lunas']);

        return back()->with('success','Pembayaran selesai');
    }
}
