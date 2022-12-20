<?php

namespace App\Http\Controllers\ChildDealer;

use App\Http\Controllers\Controller;
use App\Model\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $child = Dealer::where('user_id', Auth::id())->first();
        $parent = Dealer::find($child->parent_id);
        return view('backend.child_dealer.profile.parent_profile', compact('child', 'parent'));
    }
    /**
     * Child dealer profile
     * @return response view
     */
    public function my_profile()
    {
        $child = Dealer::where('user_id', Auth::id())->first();
        return view('backend.child_dealer.profile.my_profile', compact('child'));
    }
}
