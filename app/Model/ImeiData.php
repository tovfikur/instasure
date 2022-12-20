<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class ImeiData extends Model
{
    protected $guarded = [];
    protected $table = 'imei_datas';
    protected $fillable = [
        'imei_1', 'imei_2', 'parent_id', 'is_used', 'status'
    ];


    /**
     * Medi data bas one mobile diagnosis
     */

    public function mobile_diagnosis()
    {
        return $this->hasOne(MobileDiagnosis::class, 'imei_data_id');
    }

    /**
     * Relationship: Belongs to dealer
     */

    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'parent_id');
    }

    /**
     * Get imei data list using ajax call
     * @return response
     */

    public static function get_imei_data_list_ajax()
    {

        $query = ImeiData::query();

        return Datatables::of($query)
            ->addColumn('actions', function (ImeiData $model) {
                if ($model->is_used != false) {
                    return '<a title="Used data can not be modified" class="btn btn-secondary btn-sm" target="_blank" /><i class="fa fa-edit"></i></a>';
                }
                return  '<a title="Edit" class="btn btn-warning btn-sm" href="' . route('admin.imei-data.edit', $model->id) . '" /><i class="fa fa-edit"></i></a>';
            })
            ->editColumn('created_at', function (ImeiData $model) {
                return dateFormat($model->created_at);
            })
            ->editColumn('parent_id', function (ImeiData $model) {
                return !empty($model->dealer)
                    ? $model->dealer->parent->com_org_inst_name . ' <i class="fas fa-caret-right"></i> ' . $model->dealer->com_org_inst_name
                    : '<del>Not set</del>';
            })
            ->editColumn('is_used', function (ImeiData $model) {
                $html = "";
                if ($model->is_used) {
                    $html = '<span class="badge badge-secondary">Used</span>';
                } else {
                    $html = '<span class="badge badge-info">Available</span>';
                }
                return $html;
            })
            ->editColumn('status', function (ImeiData $model) {
                $html = "";
                if ($model->status) {
                    $html = '<a onclick="return confirm(`Are you sure?`)" href="' . route('admin.imei_data.change_status', $model) . '"><span class="badge badge-success">Active</span></a>';
                } else {
                    $html = '<a onclick="return confirm(`Are you sure?`)" href="' . route('admin.imei_data.change_status', $model) . '"><span class="badge badge-danger">Inactive</span></a>';
                }
                return $html;
            })

            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'parent_id', 'is_used', 'status'])
            ->toJson();
    }
}
