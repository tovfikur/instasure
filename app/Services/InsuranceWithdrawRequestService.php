<?php

namespace App\Services;

use Illuminate\Http\Client\Request;
use App\Model\InsuranceWithdrawRequest;

class InsuranceWithdrawRequestService
{
    /**
     * Store new InsuranceWithdrawRequest
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\User $user_id child dealer auth id
     * @param \App\Model\User $parent_id parent dealer auth id
     * @return boolean
     */
    public function create($request, $user_id, $parent_id)
    {
        $insuranceWithdrawRequest                       = new InsuranceWithdrawRequest();
        $insuranceWithdrawRequest->user_id              = $user_id;
        $insuranceWithdrawRequest->parent_id            = $parent_id;
        $insuranceWithdrawRequest->amount               = $request->amount;
        $insuranceWithdrawRequest->trx                  = getTrx();
        if ($request->type == 'bank_info') {
            $bankInfo['type']                           = $request->type;
            $bankInfo['bank_name']                      = $request->bank_name;
            $bankInfo['acc_holder_name']                = $request->acc_holder_name;
            $bankInfo['account_number']                 = $request->account_number;
            $bankInfo['branch_name']                    = $request->branch_name;
            $bankInfo['routing_number']                 = $request->routing_number;
            $insuranceWithdrawRequest->withdraw_infos   = json_encode($bankInfo);
        }
        if ($request->type == 'mob_banking') {
            $MobileBanking['type']                      = $request->type;
            $MobileBanking['provider_name']             = $request->provider_name;
            $MobileBanking['phone']                     = $request->phone;
            $insuranceWithdrawRequest->withdraw_infos   = json_encode($MobileBanking);
        }
        $insuranceWithdrawRequest->message              = $request->message;
        $insuranceWithdrawRequest->status               = 'pending';
        if ($insuranceWithdrawRequest->save()) {
            return $insuranceWithdrawRequest;
        }
        return false;
    }
}
