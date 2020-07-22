<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Manual;
use App\QrSheet;
use App\FeedMessage;
use Illuminate\Http\Request;

class FeedMessageController extends Controller
{
    public function manuals(Request $request)
    {
      $feedMessages = FeedMessage::where('reference_type', Manual::class)->orderBy('updated_at','desc')->paginate(10);
      return response()->json($feedMessages);
    }

    public function quotes(Request $request){

        $conditions = [['reference_type',Quote::class]];
        $feedMessages = FeedMessage::where($conditions)->orderBy('updated_at','desc')->paginate(10);
        return response()->json($feedMessages);
    }

    public function qrsheets(Request $request){
        $feedMessages = FeedMessage::where('reference_type', QrSheet::class)->orderBy('updated_at', 'desc')->paginate(10);
        return response()->json($feedMessages);
    }

}
