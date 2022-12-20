<?php

namespace App\Http\Controllers\ParentDealer;

use App\Model\Dealer;
use App\Model\DeviceInsurance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\InsuranceWithdrawRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $parentDealer               = Dealer::where('user_id', Auth::id())->first();
        $deviceInsSale              = DeviceInsurance::where('parent_dealer_id', $parentDealer->id)->where('status', 'completed');
        $data['totalInsSale']       = $deviceInsSale->count();
        $data['totalEarn']          = $deviceInsSale->sum('child_dealer_commission');
        $data['dealerBalance']      = $parentDealer->dealer_balance;
        $data['dueBalance']         = $parentDealer->due_balance;
        $data['childDealers']       = Dealer::where('parent_id', $parentDealer->id)->count();
        $data['paid_by_admin']      = InsuranceWithdrawRequest::where('status', '=', 'paid')->where('parent_id', Auth::id())->where('user_id', '==', 0)->sum('amount');
        $data['received_amount']    = InsuranceWithdrawRequest::where('status', '=', 'received')->where('parent_id', Auth::id())->where('user_id', '==', 0)->sum('amount');
        $data['pending_amount']     = InsuranceWithdrawRequest::where('status', '=', 'pending')->where('parent_id', Auth::id())->where('user_id', '==', 0)->sum('amount');

        return view('backend.parent_dealer.dashboard', $data);
    }
    /**
     * Parent dealer profile
     */
    public function profile()
    {
        $dealerDetails = Dealer::where('user_id', Auth::id())->with(['user'])->withCount('child_dealers')->first();

        return view('backend.parent_dealer.profile', compact('dealerDetails'));
    }
}
