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
      $feedMessages = FeedMessage::where('reference_type', Manual::class)->orderBy('created_at','desc')->paginate(10);
      return response()->json($feedMessages);
    }

    public function quotes(Request $request){
        $feedMessages = FeedMessage::where('reference_type', Quote::class)->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($feedMessages);
    }

    public function qrsheets(Request $request){
        $feedMessages = FeedMessage::where('reference_type', QrSheet::class)->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($feedMessages);
    }

}
