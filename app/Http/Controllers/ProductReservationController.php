<?php

namespace App\Http\Controllers;

use App\ProductReservation;
use Illuminate\Http\Request;

class ProductReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $input = $request->all();

        // id, product_id, product_artnr, reserved
        $reservation = ProductReservation::where('product_id', $id)->firstOr(function(){
            ProductReservation::create($input);
        });

        $reservation->reserved += $input['reserved'];
        $reservation->save();

        return response()->json(['succes' => 'reservation created'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductReservation  $productReservation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductReservation $productReservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductReservation  $productReservation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductReservation $productReservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductReservation  $productReservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductReservation $productReservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductReservation  $productReservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductReservation $productReservation)
    {
        //
    }
}
