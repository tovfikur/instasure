<?php

namespace App\Model;

use Yajra\Datatables\Datatables;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = ['brand_id', 'model_id', 'user_id', 'parent_dealer_id', 'parts_name', 'parts_price', 'status', 'is_used', 'note'];
    /**
     * Mutators for parts_name attribute
     * @return name
     */
    public function getPartsNameAttribute($value)
    {
        return ucwords($value);
    }
    /**
     * Relationship
     *
     */
    public function dealer()
    {
        return $this->belongsTo('App\Model\Dealer', 'parent_dealer_id');
    }
    /**
     * Parts belongs to brand relationship
     *
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    /**
     * Parts belongs to model relationship
     *
     */
    public function model()
    {
        return $this->belongsTo(DeviceModel::class, 'model_id');
    }
    /**
     * Parts list ajax request
     *
     */

    public static function ajax()
    {

        $query = Part::query()->with(['dealer', 'brand', 'model'])->orderBy('id', 'desc');

        return Datatables::of($query)
            ->addColumn('actions', function (Part $model) {
                $html = '<a id="parts_edit_btn" href="' . route('admin.parts.edit', [$model]) . '" class="mr-2" title="Edit"><span class="badge badge-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>';
                $html .= '<a id="parts_delete_btn" href="' . route('admin.parts_delete', [$model]) . '" title="Delete"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>';
                if ($model->is_used) {
                    $html = '<a class="mr-2" title="Edit not allowed"><span class="badge badge-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>';
                    $html .= '<a title="Delete not allowed"><span class="badge badge-secondary"><i class="fa fa-trash"></i></span></a>';
                }
                return $html;
            })
            ->editColumn('brand_id', function (Part $model) {
                if (!empty($model->brand)) {
                    return  ucwords($model->brand->name);
                }
                return '<del class="text-secondary">None</del>';
            })
            ->editColumn('model_id', function (Part $model) {
                if (!empty($model->model)) {
                    return  ucwords($model->model->name);
                }
                return '<del class="text-secondary">None</del>';
            })
            ->editColumn('parts_name', function (Part $model) {
                return ucfirst($model->parts_name);
            })
            ->addColumn('dealer', function (Part $model) {
                if (!empty($model->dealer)) {
                    return  ucfirst($model->dealer->com_org_inst_name);
                }
                return '<del class="text-secondary">None</del>';
            })
            ->editColumn('created_at', function (Part $model) {
                return dateFormat($model->created_at);
            })
            ->editColumn('is_used', function (Part $model) {
                $html = '';
                if ($model->is_used > 0) {
                    $html .=  '<span class="badge badge-secondary">Used (' . $model->is_used . ')</span>';
                } else {
                    $html .= '<span class="badge badge-info">Fresh</span>';
                }
                return $html;
            })
            ->editColumn('status', function (Part $model) {
                $html = '';
                if ($model->status == 1) {
                    $html .=  '<span class="badge badge-success">Active</span>';
                } else {
                    $html .= '<span class="badge badge-secondary">Inactive</span>';
                }
                return $html;
            })
            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'status', 'is_used', 'dealer', 'brand_id', 'model_id'])
            ->toJson();
    }
}
