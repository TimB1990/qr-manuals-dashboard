<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Product;
use App\Customer;
use App\QuoteProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\QuoteConfirmationMailable;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id' => 'required|integer',
            'product_artnr' => 'required',
            'company' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|min:10',
            'address' => 'required',
            'post_code' => 'required',
            'residence' => 'required',
            'amount' => 'required|integer|between:1,500',
            'status' => ['required', Rule::in(['pending','processed','approved','denied','released'])]
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()],400);
        }
        else{
            // get all from request
            $input = $request->all();
            // send email
            Mail::to($input['email'])->send(new QuoteConfirmationMailable($input));
            // encrypt input email
            $input['email'] = Crypt::encryptString($input['email']);
            // encrypt phone if present
            if(isset($input['phone'])){
                $input['phone'] = Crypt::encryptString($input['phone']);
            }

            // retrieve productid
            $productid = $request->input('product_id');
            // retrieve customer inputs
            $customer_inputs = $request->only(['email','company','contact', 'phone','address','post_code','residence']);
            // create customer record
            Customer::create($customer_inputs);
            // retrieve customer id
            $customer_id = Customer::where('email',$customer_inputs['email'])->first()->id;

            $quote = Quote::create(['customers_id' => $customer_id, 'quotes_products_id' => 0, 'amount' => $request->input('amount'), 'status' => "pending"]);
            $quoteId = $quote->id;

            $product = Product::find($productid);

            // create quote product record
            $quoteProduct = QuoteProduct::create([
                'origin_products_id' => $productid,
                'quotes_id' => $quoteId,
                'unit_price' => $product->unit_price,
                'artnr' => $product->artnr,
                'name' => $product->name,
                'kind' => $product->kind
            ]);

            $quoteProductId = $quoteProduct->id;

            // insert quoteProductId into quote record
            $quote->quotes_products_id = $quoteProductId;
            $quote->save();

            // return response
            return response()->json(['success' => 'quote created'],201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
