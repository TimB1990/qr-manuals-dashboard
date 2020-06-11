<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use App\Mail\PriceSpecMailable;
use App\QuotePriceSpecification;
use Illuminate\Support\Facades\Mail;

class QuotePriceSpecificationController extends Controller
{

    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        // requires review
        $id = $request->route('id');
        $quote = Quote::find($id);
        $input = $request->all();

        // save
        $specification = QuotePriceSpecification::create($input);

        // setup data to be sent along with specification
        $customer = $quote->customer;
        $productInfo = [
            'name' => $quote->quoteProducts[0]->name,
            'artnr' => $quote->quoteProducts[0]->artnr,
            'amount' => $quote->amount
        ];

        // assemble complete data to be used in mailable
        $data = [
            'id' => $id,
            'customer' => $customer,
            'product' => $productInfo,
            'specification' => $specification
        ];


        // send email
        Mail::to(Quote::find($id)->customer->email)->send(new PriceSpecMailable($data));
    }

    public function show(QuotePriceSpecification $quotePriceSpecification)
    {
        // load specification to add 
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
