<?php

namespace App\Model;

use App\User;
use Yajra\Datatables\Datatables;
use App\Model\TravelInsPlansCategory;
use Illuminate\Database\Eloquent\Model;

class TravelInsOrder extends Model
{
    protected $appends = ['_policy_certificate_path'];

    /**
     * Policy certificate custom attribute
     * @return string path
     */
    public function getPolicyCertificatePathAttribute()
    {
        $path = null;
        if (!empty($this->policy_certificate)) {
            $path = asset($this->policy_certificate);
        }
        return $path;
    }

    /**
     * Travel insurance order belongs to TravelInsPlansCategory
     * @return \App\Model\TravelInsPlansCategory TravelInsPlansCategory
     */
    public function travelInsPlansCategory()
    {
        return $this->belongsTo(TravelInsPlansCategory::class, 'travel_ins_plans_category_id');
    }


    /**
     * Travel insurance order belongs to user
     * @return \App\User user
     */
    public function policy_provider()
    {
        return $this->belongsTo(PolicyProvider::class, 'insurance_provider_id');
    }

    /**
     * Travel insurance order belongs to user
     * @return \App\User user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Travel insurance order belongs to dealer
     * @return \App\User user
     */
    public function dealer()
    {
        return $this->belongsTo(User::class, 'dealer_user_id');
    }


    /**
     * Get list of resources on ajax call
     * @return \Illuminate\Http\Response datatable
     */

    public static function ajax_datatable()
    {

        $query = self::query();

        return Datatables::of($query)
            ->addColumn('actions', function (self $model) {
                $html = "";
                $html .= '<div class="btn-group mr-2 btn-group-vertical" role="group" aria-label="First group">
                <a href="' . route('admin.travel_insurance_orders.edit', $model) . '" class="btn btn-warning" title="View & Edit Order">
                    <i class="fa fa-edit"></i>
                </a>';


                $html .= '
                <a href="' . route('admin.travel_insurance_orders.download_traveller_info', $model) . '" class="btn btn-dark" title="Download Customer Info">
                    <i class="fa fa-file-excel"></i>
                </a>';

                if (!empty($model->policy_certificate)) {
                    $html .= '
                    <a href="' . $model->policy_certificate_path . '" class="btn btn-primary" title="Download Policy Certificate" target="_blank">
                        <i class="fa fa-download"></i>
                    </a>';
                }

                $html .= '</div>';
                return $html;
            })
            ->editColumn('created_at', function (self $model) {
                return dateFormat($model->created_at);
            })
            ->addColumn('traveller_info', function (self $model) {
                $html = "";
                $html .= "<strong>Name:</strong> " . ucwords($model->full_name) . '<br/>';
                $html .= "<strong>Phone:</strong> " . ($model->phone) . '<br/>';
                $html .= "<strong>Email:</strong> " . ($model->email) . '<br/>';
                $html .= "<strong>Date of Birth:</strong> " . date_format_custom($model->dob, 'd M, Y') . '<br/>';
                $html .= "<strong>Age:</strong> " . ($model->age) . ' Years <br/>';
                $html .= "<strong>Passport Number:</strong> " . ucwords($model->passport_number) . '<br/>';
                $html .= "<strong>Passport Expire Date:</strong> " . date_format_custom($model->passport_expire_till, 'd M, Y') . '<br/>';
                return $html;
            })
            ->addColumn('other_info', function (self $model) {
                $html = "";
                $html .= "<strong>Package Info:</strong> " . ($model->travel_insurance_category_title) . '<br/>';
                if (strtolower($model->status) == 'pending') {
                    $html .=  "<strong>Order Status:</strong> " . '<span class="badge badge-secondary">Pending</span> <br/>';
                } elseif (strtolower($model->status) == 'processing') {
                    $html .=  "<strong>Order Status:</strong> " . '<span class="badge badge-primary">Processing</span> <br/>';
                } elseif (strtolower($model->status) == 'canceled') {
                    $html .=  "<strong>Order Status:</strong> " . '<span class="badge badge-danger">Canceled</span> <br/>';
                } else {
                    $html .=  "<strong>Order Status:</strong> " . '<span class="badge badge-success">Completed</span> <br/>';
                }

                if (strtolower($model->payment_status) == 'unpaid') {
                    $html .=  "<strong>Payment Status:</strong> " . '<span class="badge badge-secondary">Unpaid</span><br/>';
                } else {
                    $html .=  "<strong>Payment Status:</strong> " . '<span class="badge badge-success">Paid</span><br/>';
                }
                $html .= "<strong>Total Days:</strong> " . ($model->total_date) . '<br/>';
                $html .= "<strong>Order Date:</strong> " . '<span class="badge badge-info">' . date_format_custom($model->created_at, 'd M, Y') . '</span><br/>';
                $html .= "<strong>Policy Number:</strong> " . ($model->policy_number) . '<br/>';
                return $html;
            })
            ->addColumn('insurance_details', function (self $model) {
                $html = "";
                $html .= "<strong>Insurance Price:</strong> " . ($model->ins_price) . ' ' . config('settings.currency') . '<br/>';
                $html .= "<strong>Total Vat:</strong> " . ($model->total_vat) . ' ' . config('settings.currency')  . '<br/>';
                $html .= "<strong>Service Amount:</strong> " . ($model->service_total_amount) . ' ' . config('settings.currency')  . '<br/>';
                $html .= "<strong>Grand Ttotal:</strong> " . ($model->grand_total) . ' ' . config('settings.currency')  . '<br/>';

                $html .= "<strong>Flight Number:</strong> " . ($model->flight_number) . '<br/>';
                $html .= "<strong>Flight Date:</strong> " . date_format_custom($model->flight_date, 'd M, Y') . '<br/>';
                $html .= "<strong>Return Date:</strong> " . date_format_custom($model->return_date, 'd M, Y') . '<br/>';


                return $html;
            })

            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'traveller_info', 'insurance_details', 'other_info'])
            ->toJson();
    }
}
