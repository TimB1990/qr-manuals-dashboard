<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfUploadsController extends Controller
{

    public function index()
    {

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $files = $request->file('files');

        foreach($files as $file) {
            $file->store('files', 'public');
        }

        return response()->json(['success'=>'upload successful']);

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
