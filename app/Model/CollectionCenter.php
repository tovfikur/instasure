<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class CollectionCenter extends Model
{
    /**
     * Accessor for center_name
     * @return value
     */
    public function getCenterNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Accessor for contact_person_name
     * @return value
     */
    public function getContactPersonNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Accessor for address
     * @return value
     */
    public function getAddressAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Collection center belongs to user
     * @return User
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Collection center belongs to division
     * @return Division
     */
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    /**
     * Collection center belongs to district
     * @return District
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Collection center belongs to upazila
     * @return Upazila
     */
    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    /**
     * Collection center belongs to upazila
     * @return Upazila
     */
    public function parent_dealer()
    {
        return $this->belongsTo(Dealer::class, 'parent_id');
    }

    /**
     * Collection center datatable
     * @return datatable
     */

    public static function collection_center_datatable()
    {

        $query = CollectionCenter::query()->orderBy('id', 'desc');

        return DataTables::of($query)
            ->addColumn('actions', function (CollectionCenter $model) {
                $html = '<a id="parts_edit_btn" href="' . route('admin.collection-center.edit', [$model]) . '" class="mr-2" title="Edit"><span class="badge badge-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>';
                $html .= '<a id="view_btn" href="' . route('admin.collection-center.show', [$model]) . '" title="View"><span class="badge badge-dark"><i class="fa fa-eye"></i></span></a>';

                return $html;
            })
            ->editColumn('status', function (CollectionCenter $model) {
                $html = '';
                if ($model->status == 1) {
                    $html .=  '<a onclick="return confirm(\'Are you sure?\')" href="' . route('admin.collection-center.change_status', [$model]) . '"><span class="badge badge-success">Active</span></a>';
                } else {
                    $html .= '<a onclick="return confirm(\'Are you sure?\')" href="' . route('admin.collection-center.change_status', [$model]) . '"><span class="badge badge-secondary">Inactive</span></a>';
                }
                return $html;
            })
            ->editColumn('created_at', function (CollectionCenter $model) {
                return date_format_custom($model->created_at, 'd M, Y');
            })
            ->editColumn('commission_value', function (CollectionCenter $model) {
                return $model->commission_value . ' ' . config('settings.currency');
            })
            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'status', 'is_used', 'dealer', 'brand_id', 'model_id'])
            ->toJson();
    }
}
