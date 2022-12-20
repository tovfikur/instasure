<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\TravelInsOrder;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function invoice($id){
        $travelOrder = TravelInsOrder::find($id);
//        $pdf = PDF::setOptions([
//            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
//            'logOutputFile' => storage_path('logs/log.htm'),
//            'tempDir' => storage_path('logs/')
//        ])->loadView('frontend.invoice', compact('travelOrder'));
//        return $pdf->download('test.pdf');
        return view('frontend.invoice',compact('travelOrder'));
    }
}
