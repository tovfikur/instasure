<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class PaymentRequestToAdmin extends Model
{
    protected $fillable = [
        'requests_id', 'grand_total', 'status'
    ];
    /**
     * Relationship
     *
     */

    public function payment_request_to_admin_details()
    {
        return $this->hasMany(PaymentRequestToAdminDetail::class, 'payment_request_to_admin_id');
    }
    public function message()
    {
        return $this->morphOne(Message::class, 'messageable');
    }



    /**
     * Claim payment request ajax request
     *
     */

    public static function payment_request_to_admin_ajax($status, $user_type = 'admin')
    {
        $statusArr = ['pending', 'paid', 'approved', 'rejected'];
        $query = PaymentRequestToAdmin::query()->where('status', $status)->with(['payment_request_to_admin_details', 'message']);
        if (!in_array($status, $statusArr)) {
            $query = PaymentRequestToAdmin::query()->with(['payment_request_to_admin_details', 'message']);
        }

        return Datatables::of($query)
            ->addColumn('actions', function (PaymentRequestToAdmin $model) use ($user_type) {
                $html = $user_type == 'admin'
                    ? PaymentRequestToAdmin::getActionsHtml($model, 'admin.serviceChargeWithdrawRequestDetails', 'admin.withdraw_payment_request_from_parent_dealer_status_modal')
                    : PaymentRequestToAdmin::getActionsHtml($model, 'parentDealer.device_insurance_withdraw_request_to_admin_details', 'admin.withdraw_payment_request_from_parent_dealer_status_modal', 'parent');
                return $html;
            })
            ->editColumn('created_at', function (PaymentRequestToAdmin $model) {
                return dateFormat($model->created_at);
            })
            ->editColumn('grand_total', function (PaymentRequestToAdmin $model) {
                return $model->grand_total . ' ' . config('settings.currency');
            })
            ->addColumn('count_claimed_request', function (PaymentRequestToAdmin $model) {
                return $model->payment_request_to_admin_details->count();
            })
            ->editColumn('status', function (PaymentRequestToAdmin $model) {
                $html = '';
                if ($model->status == 'paid') {
                    $html .=  '<span class="badge badge-success">Paid</span>';
                } elseif ($model->status == 'approved') {
                    $html .= '<span class="badge badge-info">Approved</span>';
                } elseif ($model->status == 'rejected') {
                    $html .= '<span class="badge badge-danger">Rejected</span>';
                } else {
                    $html .= '<span class="badge badge-warning">Pending</span>';
                }
                return $html;
            })
            ->addColumn('checkbox', function (PaymentRequestToAdmin $model) {
                return '<input type="checkbox" name="checkbox_row" data-id=' . $model->id . '  />';
            })
            ->addColumn('message', function (PaymentRequestToAdmin $model) {
                if (isset($model->message) && !empty($model->message->message)) {
                    return '<span class="text-info">' . ucfirst($model->message()->orderBy('id', 'desc')->first()->message) . '</span>';
                }
                return '<span class="text-secondary">' . 'No message' . '</span>';
            })
            ->addColumn('payable_amount', function (PaymentRequestToAdmin $model) {
                $payable_amount = 0;
                $payment_request_to_admin = PaymentRequestToAdmin::with(['payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.device_claimed_parts', 'payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.user'])->where('id', $model->id)->first();
                foreach ($payment_request_to_admin->payment_request_to_admin_details as  $payment_request_to_admin_details) {
                    foreach ($payment_request_to_admin_details->claim_payment_requests->claim_payment_request_details as $claim_payment_request_details) {
                        $payable_amount += $claim_payment_request_details->device_claims->settlement_amount;
                    }
                }
                return $payable_amount . ' ' . config('settings.currency');
            })
            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'checkbox', 'status', 'message'])
            ->toJson();
    }
    /**
     * Claim payment request ajax request
     *
     */
    public static function getActionsHtml($model, $route_details = null, $route_status = null, $user_type = 'admin')
    {
        return $user_type == 'admin' ? '
                <div class="dropleft">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="' . route($route_details, $model->id) . '"  />
                            <i class="fa fa-eye text-primary"></i> Details
                        </a>
                        <a class="dropdown-item edit" href="' . route($route_status, $model->id) . '" id="edit" data-id="' . $model->id . '" />
                        <i class="fa fa-stream text-info" ></i> Status
                        </a>
                    </div>
                </div>
                '
            : '
                <div class="dropleft">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="' . route($route_details, $model->id) . '"  />
                            <i class="fa fa-eye text-primary"></i> Details
                        </a>
                    </div>
                </div>
                ';
    }
}
