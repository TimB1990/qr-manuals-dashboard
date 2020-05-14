<?php

namespace App\Http\Controllers;

use App\QuotePriceSpecification;
use Illuminate\Http\Request;

class QuotePriceSpecificationController extends Controller
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
    public function store(Request $request)
    {
        $id = $request->route('id');
        $inputs = $request->all();
        $originalUnitPrice = QuoteProduct::where('quote_id',$id)->get()->unit_price;
        $amount = Quote::where('id',$id)->get()->amount;

        $totalPrice = $inputs['new_unit_price'] * $amount;
        $tax = $totalPrice * $inputs['tax_percentage'];
        $discount = ($originalUnitPrice * $amount) - $totalPrice;
        $shippingTax = $inputs['shipping_per_unit'] * $amount * $inputs['shipping_tax_percentage'];
        $finalTotal = $totalPrice + $tax + ($inputs['shipping_per_unit'] * $amount) + $shippingTax;

        QuotePriceSpecification::create(['quote_id' => $id, 'new_unit_price' => $inputs['new_unit_price'], 'total' => $totalPrice, 'discount' => $discount, 'tax' => $tax, 'shipping_per_unit' => $inputs['shipping_per_unit'], 'shipping_tax' => $shippingTax, 'final_total' => $finalTotal]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuotePriceSpecification  $quotePriceSpecification
     * @return \Illuminate\Http\Response
     */
    public function show(QuotePriceSpecification $quotePriceSpecification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuotePriceSpecification  $quotePriceSpecification
     * @return \Illuminate\Http\Response
     */
    public function edit(QuotePriceSpecification $quotePriceSpecification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuotePriceSpecification  $quotePriceSpecification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuotePriceSpecification $quotePriceSpecification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuotePriceSpecification  $quotePriceSpecification
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuotePriceSpecification $quotePriceSpecification)
    {
        //
    }
}
