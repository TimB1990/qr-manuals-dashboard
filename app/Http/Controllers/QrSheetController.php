<?php

namespace App\Http\Controllers;

use App\QrSheet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrSheetController extends Controller
{

    public function index()

    {
        // $sheets = QrSheet::select('id','alias','pages','product_amount')->get();
        $sheets = QrSheet::all();
        return response()->json($sheets);
    }

    public function create()
    {
        //
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

            // dd($items);

            // create
            $record = QrSheet::updateOrCreate([
                'alias' => $alias
            ],[
                'pages' => $pages,
                'page_width_mm' => $pageWidth,
                'page_height_mm' => $pageHeight,
                'rows_per_page' => $rpp,
                'cols_per_page' => $cpp,
                'product_amount' => $amount
            ]);

            $sheetId = $record->id;
            $itemRefs = [];

            // loop over items
            foreach($items as $item){
                $itemRef = [
                    'qr_sheet_id' => $sheetId,
                    'product_id' => $item['id']
                ];

                array_push($itemRefs, $itemRef);   
            }

            // insert data into product_qrsheet table
            DB::table('product_qr_sheet')->insert($itemRefs);
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
                'item_id' => $product->id,
                'item_name' => $product->name,
                'item_artnr' => $product->artnr
            ]);
        }

        return response()->json($responseObj);

    }

    public function downloadPDF(Request $request){

        // find sheet by id
        $id = $request->route('id');
        $sheet = QrSheet::find($id);

        /*// set item dimensions
        $itemheight = $sheet->page_height_mm / $sheet->rows_per_page;
        $itemwidth = $sheet->page_width_mm / $sheet->cols_per_page;
        $qrRatio = 0.8;

        // calculate qrcode size in pixels
        $qrsize = sqrt(($itemheight * $itemwidth) * $qrRatio *3.78);

        // find each product artnr in sheet->products and store as  .png file
        foreach($sheet->products as $p){
            $id = $p->id;
            $artnr = $p->artnr;
            QrCode::size($qrsize)->format('png')->generate($artnr, '../public/qrcodes/qr_'.$id.'.png');
        }*/

        // 72pt/inch, 1 inch = 25.4mm
        // A4 210 x 297
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
