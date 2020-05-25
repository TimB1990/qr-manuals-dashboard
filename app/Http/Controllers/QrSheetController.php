<?php

namespace App\Http\Controllers;

use App\QrSheet;
use Illuminate\Http\Request;

class QrSheetController extends Controller
{

    public function index()
    {
        $sheets = QrSheets::select('id','alias','pages','product_amount')->get();
        return response()->json($sheets);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // validate 
        $validator = Validator::make($request->input('alias'),[
            'alias' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()],400);
        }
        else{
            // retrieve params
            $params = $request->all();

            // initialize variables
            $alias = $params['alias'];
            $pages = $params['pages'];
            $rpp = $params['rows_per_page'];
            $cpp = $params['cols_per_page'];
            $items = $params['items'];
            $amount = $params['product_amount'];

            // create
            $record = QrSheet::updateOrCreate([
                'alias' => $alias
            ],[
                'pages' => $pages,
                'rows_per_page' => $rpp,
                'cols_per_page' => $cpp,
                'product_amount' => $amount
            ]);

            $sheetId = $record->id;
            $itemRefs = [];

            // loop over items
            foreach($items as $item){
                $itemRef = [
                    'qrsheet_id' => $sheetId,
                    'product_id' => $item->id
                ];

                array_push($itemRefs, $itemRef);   
            }

            // insert data into product_qrsheet table
            DB::table('product_qrsheet')->insert($itemRefs);
            return response()->json(['success' => "sheet: ". $alias." has been saved"],201);
        }
    }


    public function show(Request $request)
    {
        $id = $request->route('id');
        $sheet = QrSheet::find('id');

        $responseObj = [
            'alias' => $sheet->alias,
            'pages' => $sheet->pages,
            'rows_per_page' => $sheet->rows_per_page,
            'cols_per_page' => $sheet->cols_per_page,
            'product_amount' => $sheet->product_amount,
            'items' => []
        ];

        // $products = $sheet->products;
        foreach($sheet->products as $product){
            array_push($responseObj['items'], [
                'item_id' => $product->id,
                'item_name' => $product->name,
                'item_artnr' => $product->artnr
            ]);
        }

        return response()->json($responseObj);

    }

    public function downloadPDF(Request $request){
        $id = $request->route('id');
        $sheet = QrSheet::find($id);

        $pdf = PDF::loadView('qrsheet.pdf-sheet', $sheet);
        $filename = $sheet->alias . ".pdf";
        return $pdf->download($filename);

    }


    public function edit(QrSheet $qrSheet)
    {
        //
    }


    public function update(Request $request, QrSheet $qrSheet)
    {
        //
    }

    public function delete(Request $request){
        // for this method you should uncomment properties in model and migration to softdelete
        $id = $request->route('id');
        $sheet = QrSheet::find($id);
        $sheet->delete();

    }

    public function restore(Request $request){
        $id = $request->route('id');
        $sheet = QrSheet::find($id);
        $sheet->restore();
    }

    public function destroy(Request $request)
    {
        $id = $request->route('id');
        $sheet = QrSheet::find($id);
        $sheet->forceDelete();

    }

    public function restoreAll(){
        //

    }

    public function destroyAll(){
        //

    }
}
