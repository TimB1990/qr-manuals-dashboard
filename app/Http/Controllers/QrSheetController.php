<?php

namespace App\Http\Controllers;

use App\QrSheet;
use App\FeedMessage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrSheetController extends Controller
{

    public function index(Request $request){
        $perPage = 5;
        $q = $request->query('q');
        
        $sheets = QrSheet::select('id','alias','pages','product_amount','created_at','updated_at')->where('alias','like','%'.$q.'%')->paginate($perPage);

        return response()->json($sheets);
    }

    public function store(Request $request)
    {
        // validate 
        $validator = Validator::make($request->all(),[
            'alias' => 'required',
            'pages' => 'required|integer',
            'page_width_mm' => 'required|integer',
            'page_height_mm' => 'required|integer',
            'rows_per_page' => 'required|integer',
            'cols_per_page' => 'required|integer',
            'items' => 'required',
            'product_amount' => 'required|integer|min:1'

        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()],400);
        }
        else{
            // retrieve params,
            $params = $request->all();

            // initialize variables
            $alias = $params['alias'];
            $pages = $params['pages'];
            $pageWidth = $params['page_width_mm'];
            $pageHeight = $params['page_height_mm'];
            $rpp = $params['rows_per_page'];
            $cpp = $params['cols_per_page'];
            $items = $params['items'];
            $amount = $params['product_amount'];

            // create
            $sheet = QrSheet::updateOrCreate([
                'alias' => $alias
            ],[
                'pages' => $pages,
                'page_width_mm' => $pageWidth,
                'page_height_mm' => $pageHeight,
                'rows_per_page' => $rpp,
                'cols_per_page' => $cpp,
                'product_amount' => $amount
            ]);

            // retrieve sheet id
            $sheetId = $sheet->id;

            // delete all previous items in sheet
            DB::table('product_qr_sheet')->where('qr_sheet_id', $sheetId)->delete();
            
            // loop over items
            foreach($items as $item){

                DB::table('product_qr_sheet')->insert(
                    ['qr_sheet_id' => $sheetId, 'product_id' => $item['id']],
                    ['product_id' => $item['id']]); 
            }

            $action = "";

            // create new feedmessage using $action to indicate 'created' or 'updated'
            if($sheet->updated_at != $sheet->created_at){
                $action = "updated";
            }
            else{
                $action = "created";
            }
            
            $feedMessage = $sheet->feedMessages()->save(new FeedMessage([
                'user_id' => auth()->id(),
                'message' => auth()->user()->name . " " . $action . " sheet: " . $sheet->alias . " at " . $sheet->updated_at 
            ]));    


            return response()->json(['success' => "sheet: ". $alias." has been saved"],201);
        }
    }


    public function show(Request $request)
    {
        $id = $request->route('id');
        $sheet = QrSheet::find($id);

        $responseObj = [
            'id' => $sheet->id,
            'alias' => $sheet->alias,
            'pages' => $sheet->pages,
            'page_width_mm' => $sheet->page_width_mm,
            'page_height_mm' => $sheet->page_height_mm,
            'rows_per_page' => $sheet->rows_per_page,
            'cols_per_page' => $sheet->cols_per_page,
            'product_amount' => $sheet->product_amount,
            'items' => []
        ];

        // $products = $sheet->products;
        foreach($sheet->products as $product){
            array_push($responseObj['items'], [
                'id' => $product->id,
                'artnr' => $product->artnr,
                'kind' => $product->kind
            ]);
        }

        return response()->json($responseObj);

    }

    public function downloadPDF(Request $request){

        // find sheet by id
        $id = $request->route('id');
        $sheet = QrSheet::find($id);


        $paperWidthPt = $sheet->page_width_mm * (72 / 25.4);
        $paperHeightPt = $sheet->page_height_mm * (72 / 25.4);
        
        $paperFormat = array(0,0,$paperWidthPt,$paperHeightPt);

        $pdf = PDF::loadView('qrsheet.pdf-sheet', compact('sheet'))->setPaper($paperFormat, 'portrait');
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
        // QUERY EXCEPTION!
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
