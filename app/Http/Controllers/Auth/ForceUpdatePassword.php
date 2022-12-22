<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Dealer;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ForceUpdatePassword extends Controller
{
    public function change_password(User $user)
    {
        return view('backend.admin.users.change_password_modal', compact('user'));
    }
    /**
     * Change user password using ajax
     * @param Request $request
     * @param User $user
     * @return response json
     */

    public function change_password_ajax(Request $request, User $user)
    {
        if ($request->password) {
            
            $user->password = Hash::make($request->password);
            $user->save();
            Toastr::success('You have successfully changed your passowrd');
        } else {
            Toastr::error('Re-try changing your password');
        }
    }
    
}