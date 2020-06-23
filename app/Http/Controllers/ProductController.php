<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $term = $request->query('q');
        // $productslist = Product::paginate(2);
        $productslist = Product::where(
            'name','like','%'.$term.'%'
            )->orWhere('artnr','like','%'.$term.'%')->paginate(5);

        foreach ($productslist as $product){

            $product->categories;
        }

        return response()->json($productslist);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function showByArtnr($artnr){
        $product = Product::where('artnr',$artnr)->get();
        return response()->json($product);
    }


    public function show($id)
    {
        $product = Product::where('id',$id)->get();
        return response()->json($product);
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }
}
