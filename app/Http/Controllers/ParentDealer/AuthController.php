<?php

namespace App\Http\Controllers\ParentDealer;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        $parentDealers = User::where('user_type', 'parent_dealer')->latest()->get();
        return view('auth.dealer.dealer-register', compact('parentDealers'));
    }
    public function regDataStore(Request $request)
    {
        $reg = new User();
        $reg->name = $request->name;
        //$reg->email = $request->email;
        $reg->phone = $request->phone;
        $reg->phone = $request->phone;
        $reg->phone = $request->phone;
    }
}
