<?php

namespace App\Http\Controllers;

use App\Model\District;
use App\Model\Upazila;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getDistrict(Request $request){
        $districts = District::where('division_id',$request->division_id)->get();
        return $districts;
    }
    public function getUpazila(Request $request){
        $upazilas = Upazila::where('district_id',$request->district_id)->get();
        return $upazilas;
    }
}
