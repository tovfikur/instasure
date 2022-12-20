<?php

namespace App\Model;

use App\Model\Dealer;
use Yajra\Datatables\Datatables;
use Illuminate\Database\Eloquent\Model;

class DueBalanceCollection extends Model
{
    protected $table = 'due_balance_collections';

    /**
     * Due balance collection belongs to dealer
     */
    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    /**
     * Create datatable
     * @return response datatable
     */

    public static function due_balance_collection_ajax()
    {

        $query = self::query()->latest();

        return Datatables::of($query)
            ->addColumn('actions', function (self $model) {

                $html = '<a title="Change Status" class="btn btn-info btn-sm btn_edit" href="' . route('admin.commission_withdraw_request_edit', $model) . '"/><i class="fas fa-pencil-square-o "></i></a>';
                return $html;
            })

            ->editColumn('dealer_id', function (self $model) {
                return ucwords($model->dealer->com_org_inst_name);
            })

            ->editColumn('collection_date', function (self $model) {
                return date_format_custom($model->collection_date, 'd M, Y');
            })

            ->editColumn('collected_amount', function (self $model) {
                return $model->collected_amount . ' ' . config('settings.currency');
            })

            ->editColumn('previous_due_balance', function (self $model) {
                return $model->previous_due_balance . ' ' . config('settings.currency');
            })

            ->editColumn('current_due_balance', function (self $model) {
                return $model->current_due_balance . ' ' . config('settings.currency');
            })

            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
