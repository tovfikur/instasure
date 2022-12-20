<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Dealer extends Model
{
    protected $appends = ['logo_path', 'trade_license_path', 'business_id_path', 'nid_path'];

    /**
     * Custom accessor for document path attribute
     * @return name
     */
    public function getBusinessIdPathAttribute($value)
    {
        return $this->other_business_id != null
            ? array_map(fn ($document) =>  asset('uploads/other_business_id' . '/' . $document), json_decode($this->other_business_id))
            : null;
    }
    /**
     * Custom accessor for document path attribute
     * @return name
     */
    public function getNidPathAttribute($value)
    {
        return $this->nid != null
            ? array_map(fn ($document) =>  asset('uploads/nid' . '/' . $document), json_decode($this->nid))
            : null;
    }

    /**
     * Custom accessor for document path attribute
     * @return name
     */
    public function getLogoPathAttribute($value)
    {
        return $this->logo != null
            ? asset('/uploads/dealer-logo/photo') . '/' .  $this->logo
            : null;
    }

    /**
     * Custom accessor for document path attribute
     * @return name
     */
    public function getTradeLicensePathAttribute($value)
    {
        return $this->tread_license != null
            ? asset('/uploads/tread_license/photo') . '/' .  $this->tread_license
            : null;
    }

    /**
     * Accessor for com_org_ins_name attribute
     */
    public function getComOrgInstNameAttribute($value)
    {
        return ucwords($value);
    }
    /**
     * Accessor for dealer_type attribute
     */
    public function getDealerTypeAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Dealer belongs to category relation
     */
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    /**
     * Dealer belongs to user relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Dealer belongs to parent dealer relation
     */
    public function parent()
    {
        return $this->belongsTo(Dealer::class, 'parent_id');
    }

    /**
     * Child dealer has many parent dealer
     */
    public function parent_dealers()
    {
        return $this->belongsToMany(Dealer::class, 'parent_child_dealers', 'child_dealer_id', 'parent_dealer_id');
    }

    /**
     * Child dealer has many parent dealer
     */
    public function child_dealers()
    {
        return $this->hasMany(Dealer::class, 'parent_id');
    }

    /**
     * Dealer belongs to brand relation
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Parent dealer belongs to brand
     */
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'parent_brands', 'dealer_id', 'brand_id')->withTimestamps();
    }

    /**
     * Create datatable
     * @return response datatable
     */

    public static function parent_due_balance_ajax()
    {

        $query = self::query()->with(['user'])->where('due_balance', '>', 0)->latest();

        return Datatables::of($query)
            ->addColumn('actions', function (self $model) {

                $html = '<a title="Change Status" class="btn btn-info btn-sm btn_edit" href="' . route('admin.commission_withdraw_request_edit', $model) . '"/><i class="fas fa-pencil-square-o "></i></a>';
                return $html;
            })
            ->editColumn('created_at', function (self $model) {
                return date_format_custom($model->created_at, 'd M, Y');
            })
            ->editColumn('due_balance', function (self $model) {
                return $model->due_balance . ' ' . config('settings.currency');
            })

            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
