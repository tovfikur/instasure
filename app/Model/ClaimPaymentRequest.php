<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;


class ClaimPaymentRequest extends Model
{
    /**
     * Accessors for status
     */

    public function getStatusAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Claim payment request belongs to service center
     *
     */
    public function service_center()
    {
        return $this->belongsTo(ServiceCenterDetails::class, 'service_center_id');
    }

    /**
     * Claim payment request owns claim request details relationship
     *
     */
    public function claim_payment_request_details()
    {
        return $this->hasMany(ClaimPaymentRequestDetails::class, 'claim_payment_requests_id');
    }

    /**
     * Claim payment request ajax request
     *
     */

    public static function ajaxWithdrawRequest($from, $to, $claim_id, $request_status)
    {

        $date_from = $from ? $from . ' 00:00:01' : null;
        $date_to = $to ? $to . ' 23:59:59' : null;

        $query = ClaimPaymentRequest::query();
        if ($date_from && $date_to) {
            $query = $query->whereBetween('created_at', [$date_from, $date_to]);
        }
        if ($claim_id) {
            $query = $query->where(['requestId' => $claim_id]);
        }

        if ($request_status != 'all') {
            $query = $query->where('status', $request_status);
        } else {
            $query = $query->where('status', '<>', null);
        }



        return Datatables::of($query)
            ->addColumn('actions', function (ClaimPaymentRequest $model) {
                $html = '
                <div class="dropleft">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="' . route('parentDealer.device-insurance.withdraw-request.withdraw_request_details', $model->id) . '" target="_blank" />
                            <i class="fa fa-eye text-primary"></i> Details
                        </a>
                        <a class="dropdown-item" href="' . route('parentDealer.device-insurance.withdraw-request.change_request_status', $model->id) . '" id="edit" data-id="' . $model->id . '" />
                        <i class="fa fa-stream text-info" ></i> Status
                        </a>
                    </div>
                </div>
                ';
                return $html;
            })
            ->editColumn('created_at', function (ClaimPaymentRequest $model) {
                return dateFormat($model->created_at);
            })
            ->editColumn('status', function (ClaimPaymentRequest $model) {
                $status = strtolower($model->status);
                $html = '';
                if ($status == 'paid') {
                    $html .=  '<span class="badge badge-success">Paid</span>';
                } elseif ($status == 'processing') {
                    $html .= '<span class="badge badge-warning">Processing</span>';
                } else {
                    $html .= '<span class="badge badge-secondary">Pending</span>';
                }
                return $html;
            })
            ->addColumn('checkbox', function (ClaimPaymentRequest $model) {
                return '<input type="checkbox" name="checkbox_row" data-id=' . $model->id . '  />';
            })
            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'checkbox', 'status'])
            ->toJson();
    }
}
