<?php

namespace App\Http\Controllers;

use App\Manual;
use Illuminate\Http\Request;

class ManualsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, Manual $manual)
    {
        // retrieve path-parameter id from request
        $id = $request->route('id');
        $manuals = $manual->where('product_id', $id)->get();

        return response()->json($manuals);
    }

    public function edit(Manual $manual)
    {
        //
    }

    public function update(Request $request, Manual $manual)
    {
        //
    }

    public function destroy(Manual $manual)
    {
        //
    }
}
