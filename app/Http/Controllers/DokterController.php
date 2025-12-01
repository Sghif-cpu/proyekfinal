<?php
namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $data = Dokter::with('poli')->get();
        return view('dokter.index', compact('data'));
    }

    public function store(Request $request)
    {
        Dokter::create($request->all());
        return back()->with('success','Dokter ditambahkan');
    }

    public function destroy($id)
    {
        Dokter::findOrFail($id)->delete();
        return back()->with('success','Dihapus');
    }
}
