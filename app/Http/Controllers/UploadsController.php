<?php

namespace App\Http\Controllers;

use App\Manual;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
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
        // reads entire file into an array
        $files = $request->file('files');
        $id = $request->route('id');
        $artnr = Product::find($id)->artnr;

        foreach($files as $file) {
            // $file->store('files/'.$artnr, 'public');
            Storage::put('files/'.$artnr, $file);
            $file_url = Storage::url($file->hashName());
            Manual::create([
                'product_id' => $id,
                // 'file_name' => $file->getClientOriginalName(),
                'file_name' => $file->hashName(),  
                'file_url' => $file_url,
                'artnr' => $artnr
                ]);
            
        }

        return response()->json(['success'=>'upload successful']);

    }

    public function download(Request $request){

        // return Storage::download($request->route('file'), $downloadName);
        return Storage::download($request->route('filename'));
        
    }

    public function show($id)
    {

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
