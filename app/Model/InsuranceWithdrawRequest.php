<?php

namespace App\Model;

use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class InsuranceWithdrawRequest extends Model
{
    /**
     * Dealer commission withdraw request account details
     */
    public function account_details()
    {
        $details = '';
        $account = json_decode($this->withdraw_infos);
        if ($account->type == 'mob_banking') {
            $details .= 'Provider: ' . $account->provider_name . ', Phone: ' . $account->phone;
        } else {
            $details .= 'Bank Name: ' . $account->bank_name . ', Account Holder Name: ' . $account->acc_holder_name . ', Account Number: ' . $account->account_number . ', Branch Name: ' . $account->branch_name;
        }
        return  ucwords($details);
    }

    /**
     * Calculate due amount
     */
    public static function due_amount()
    {
        return self::where(function ($query) {
            $query->where('status', '=', 'pending')
                ->orWhere('status', '=', 'approved');
        })
            ->where('parent_id', Auth::id())
            ->where('user_id', '!=', 0)
            ->sum('amount');
    }

    /**
     * Calculate paid amount
     */
    public static function paid_amount($for = 'child')
    {
        return $for == 'child'
            ? self::where('status', '=', 'paid')->where('parent_id', Auth::id())->where('user_id', '!=', 0)->sum('amount')
            : self::where('status', '=', 'paid')->where('parent_id', Auth::id())->where('user_id', '==', 0)->sum('amount');
    }


    /**
     * Accessor for status attribute
     */
    public function getStatusAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Insurance commission log belongs to User
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Insurance commission log belongs to parent dealer
     */

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * Create datatable
     * @return response datatable
     */

    public static function commission_withdraw_request_ajax($activity_type)
    {
        $auth_user = Auth::user();
        if ($auth_user->user_type == 'admin') {
            $query = self::query()->with(['parent.dealer'])->where('user_id', 0)->orderBy('id', 'asc');
        } elseif ($auth_user->user_type == 'child_dealer') {
            $query = self::query()->with(['user.dealer', 'parent.dealer'])->where('user_id', Auth::id())->where('user_id', '!=', 0)->orderBy('id', 'asc');
        } else {

            if ($activity_type == 'parent_to_admin') {
                $query = self::query()->with(['parent.dealer'])->where('parent_id', Auth::id())->where('user_id', 0)->orderBy('id', 'asc');
            } elseif ($activity_type == 'child_to_parent') {
                $query = self::query()->with(['user.dealer', 'parent.dealer'])->where('parent_id', Auth::id())->where('user_id', '!=', 0)->orderBy('id', 'asc');
            }
        }
        return Datatables::of($query)
            ->addColumn('actions', function (self $model) use ($activity_type) {

                $html = '<a title="Change Status" class="btn btn-secondary btn-sm btn_edit" href="' . route('admin.commission_withdraw_request_edit', $model) . '"/><i class="fas fa-pencil-square-o "></i></a>';
                if ($activity_type == 'parent_to_admin') {
                    $html = '<a title="Change Status" class="btn btn-secondary btn-sm btn_edit" href="' . route('parentDealer.commission_withdraw_request_edit', $model) . '"/><i class="fas fa-pencil-square-o "></i></a>';
                } elseif ($activity_type == 'child_to_parent') {
                    $html = '<a title="Change Status" class="btn btn-secondary btn-sm btn_edit" href="' . route('parentDealer.child_commission_withdraw_request_edit', $model) . '"/><i class="fas fa-pencil-square-o "></i></a>';
                } elseif ($activity_type == 'admin') {
                    $html = '<a title="Change Status" class="btn btn-secondary btn-sm btn_edit" href="' . route('admin.commission_withdraw_request_edit', $model) . '"/><i class="fas fa-pencil-square-o "></i></a>';
                } else {
                    $html = '<a title="Change Status" class="btn btn-secondary btn-sm btn_edit" href="' . route('childDealer.commission_withdraw_request_edit', $model) . '"/><i class="fas fa-pencil-square-o "></i></a>';
                }
                return $html;
            })
            ->editColumn('created_at', function (self $model) {
                return date_format_custom($model->created_at, 'd M, Y');
            })
            ->editColumn('parent_id', function (self $model) {
                return ucwords($model->parent->dealer->com_org_inst_name);
            })
            ->editColumn('user_id', function (self $model) {
                if ($model->user_id) {
                    return ucwords($model->user->dealer->com_org_inst_name);
                } else {
                    return false;
                }
            })
            ->editColumn('amount', function (self $model) {
                return $model->amount . ' ' . config('settings.currency');
            })
            ->editColumn('status', function (self $model) {
                $html = '';
                if (strtolower($model->status) == 'pending') {
                    $html .= '<span class="badge badge-warning">' . $model->status . '</span>';
                } elseif (strtolower($model->status) == 'paid') {
                    $html .= '<span class="badge badge-success">' . $model->status . '</span>';
                } else {
                    $html .= '<span class="badge badge-info">' . $model->status . '</span>';
                }
                return $html;
            })
            ->addColumn('type', function (self $model) {

                $type = '';
                $withdraw_infos = json_decode($model->withdraw_infos);
                if ($withdraw_infos->type == 'mob_banking') {
                    $type .= 'Mobile Bank';
                } else {
                    $type .= 'General Bank';
                }

                return $type;
            })
            ->addColumn('provider_name', function (self $model) {
                $provider_name = '';
                $withdraw_infos = json_decode($model->withdraw_infos);
                if ($withdraw_infos->type == 'mob_banking') {
                    $provider_name = ucfirst($withdraw_infos->provider_name);
                } else {
                    $provider_name = ucfirst($withdraw_infos->bank_name);
                }
                return $provider_name;
            })
            ->addColumn('account_number', function (self $model) {
                $account_number = '';
                $withdraw_infos = json_decode($model->withdraw_infos);
                if ($withdraw_infos->type == 'mob_banking') {
                    $account_number = $withdraw_infos->phone;
                } else {
                    $account_number = $withdraw_infos->account_number;
                }
                return $account_number;
            })

            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'status'])
            ->toJson();
    }
}
