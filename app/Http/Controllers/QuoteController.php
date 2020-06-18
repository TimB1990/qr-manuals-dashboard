<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Product;
use App\Customer;
use App\QuoteProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\QuoteResource;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\QuoteCollection;
use App\Mail\QuoteConfirmationMailable;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{

    public function index(Request $request)
    {
         $perPage = 5;
        // $q = $request->query('q');
        $quotes = [];

        $total_quotes = Quote::all()->count();
        $status = $request->query('status');

        if(!($status == 'any')){
            $quotes = Quote::where('status', $status)->paginate($perPage);
        }
        else{
            $quotes = Quote::all()->paginate($perPage);
        }

        // total products of status
        $totalOfStatus = Quote::where('status', $status)->count();
        
        // calculate pages total
        $pages = ceil($totalOfStatus / $perPage);


        $responseObject = [
            'items' => [],
            'pages' => $pages,
            'count_status' => [
                'pending' => Quote::where('status','pending')->count(),
                'accepted' => Quote::where('status','accepted')->count(),
                'processed' => Quote::where('status','processed')->count(),
                'approved' => Quote::where('status','approved')->count(),
                'denied' => Quote::where('status','denied')->count(),
                'review' => Quote::where('status','review')->count(),
            ],
            'count_all' => $total_quotes
        ];

        foreach ($quotes as $quote){
            $responseItem = [
                'quote_id' => $quote->id,
                'articles' => [],
                'amount' => $quote->amount,
                'email' => $quote->customer->email,
                'company' => $quote->customer->company,
                'status' => $quote->status,
                'created_at' => $quote->created_at,
                'updated_at' => $quote->updated_at
            ];

            foreach($quote->quoteProducts as $quoteProduct){
                array_push($responseItem['articles'], $quoteProduct->artnr);
            }

            array_push($responseObject['items'], $responseItem);  
        }
        return response()->json($responseObject);
    }

    // STORE
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

            // create customer record
            Customer::firstOrCreate([
                'email' => $request->input('email')], 
                [
                    'company' => $request->input('company'),
                    'contact' => $request->input('contact'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'post_code' => $request->input('post_code'),
                    'residence' => $request->input('residence'),
                    'token' => bcrypt($request->input('email'))
                ]
            );
            // retrieve customer id
            $customer_id = Customer::where('email', $request->input('email'))->first()->id;

            $quote = Quote::create([
                'customer_id' => $customer_id, 
                 // 'quotes_products_id' => 0, 
                'amount' => $request->input('amount'), 
                'status' => "pending"]
            );

            $quoteId = $quote->id;

            $product = Product::find($productid);

            // create quote product record
            $quoteProduct = QuoteProduct::create([
                'origin_products_id' => $productid,
                'quote_id' => $quoteId,
                'unit_price' => $product->unit_price,
                'artnr' => $product->artnr,
                'name' => $product->name,
                'kind' => $product->kind
            ]);

            $quoteProductId = $quoteProduct->id;

            // insert quoteProductId into quote record
            $quote->save();

            // return response
            return response()->json(['success' => 'quote created'],201);
        }

    }

    public function show(Request $request)
    {
        $id = $request->route('id');
        $quote = Quote::find($id);

        $loadDetails = $request->query('details');
        $loadCustomer = $request->query('customer');

        if($loadDetails == 1){
            // quote details
            $customer = $quote->customer;

            if(empty($customer->phone)){
                $customer['phone'] = "no phone number provided";
            }

            $responseObject = [
                'customer' => $customer,
                'products' => [],
                'quote' => [
                    'amount' => $quote->amount,
                    'status' => $quote->status
                ]
            ];

            foreach($quote->quoteProducts as $product){
                array_push($responseObject['products'], $product);
            }
        }
        elseif($loadCustomer == 1){
            $customer = $quote->customer;
            $responseObject = $customer;
        }
        
        else{

            $responseObject = [
                'amount' => $quote->amount,
                'products' => []
            ];

            foreach($quote->quoteProducts as $product){
                array_push($responseObject['products'],$product);     
            }
        }

        return response()->json($responseObject);
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $status = $request->input('status');

        $quote = Quote::find($id);
        $quote->status = $status;
        $quote->save();
    }

    public function destroy(Quote $quote)
    {
        //
    }
}
