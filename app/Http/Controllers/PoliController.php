<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        return response('Poli index');
    }

    public function create()
    {
        return response('Poli create');
    }

    public function store(Request $request)
    {
        return response('Poli store');
    }

    public function show($id)
    {
        return response("Poli show: $id");
    }

    public function edit($id)
    {
        return response("Poli edit: $id");
    }

    public function update(Request $request, $id)
    {
        return response("Poli update: $id");
    }

    public function destroy($id)
    {
        return response("Poli destroy: $id");
    }
}
