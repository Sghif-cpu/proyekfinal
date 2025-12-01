<?php
namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $data = Obat::all();
        return view('obat.index', compact('data'));
    }

    public function store(Request $request)
    {
        Obat::create($request->all());
        return back()->with('success','Obat ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = Obat::findOrFail($id);
        $data->update($request->all());

        return back()->with('success','Obat diupdate');
    }
}
