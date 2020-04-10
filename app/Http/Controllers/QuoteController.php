<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\QuoteConfirmationMailable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

            // put in database
            Quote::create($input);
            return response()->json(['success','quote has been created'],201);

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
