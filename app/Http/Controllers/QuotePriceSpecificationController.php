<?php

namespace App\Http\Controllers;

use App\QuotePriceSpecification;
use Illuminate\Http\Request;

class QuotePriceSpecificationController extends Controller
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
        // requires review
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

    public function show(QuotePriceSpecification $quotePriceSpecification)
    {
        //
    }

    public function edit(QuotePriceSpecification $quotePriceSpecification)
    {
        //
    }


    public function update(Request $request, QuotePriceSpecification $quotePriceSpecification)
    {
        //
    }

    public function destroy(QuotePriceSpecification $quotePriceSpecification)
    {
        //
    }
}
