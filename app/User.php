<?php

namespace App;

use App\Model\Dealer;
use App\Model\Seller;
use App\Model\DeviceInsurance;
use App\Model\OauthAccessToken;
use Yajra\Datatables\Datatables;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'user_type', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Accessors for user name
     */

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * User has maney dealers
     */
    public function dealer()
    {
        return $this->hasOne(Dealer::class, 'user_id');
    }

    /**
     * User has maney oAuth access tokens
     */
    public function access_tokens()
    {
        return $this->hasMany(OauthAccessToken::class, 'user_id');
    }


    //    public function roles()
    //    {
    //        return $this
    //            ->belongsToMany('App\Role')
    //            ->withTimestamps();
    //    }
    /*public function role()
    {
        return $this->belongsTo('App\Role');
    }*/

    //    public function users()
    //    {
    //        return $this
    //            ->belongsToMany('App\User')
    //            ->withTimestamps();
    //    }

    /*public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }*/

    /*public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }*/

    /*public function hasRole($role)
    {
        //dd($role);
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }*/
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function products()
    {
        return $this->hasMany('App\Model\Product', 'user_id');
    }


    /**
     * User has maney device insurance
     */
    public function device_insurance()
    {
        return $this->hasMany(DeviceInsurance::class, 'user_id');
    }

    /**
     * Get imei data list using ajax call
     * @return response datatable
     */

    public static function users_ajax()
    {

        $query = User::query()->orderBy('id', 'desc');

        return Datatables::of($query)
            ->addColumn('actions', function (User $model) {
                $html =  '<a  title="View" class="btn btn-info btn-sm mr-1  btn_view" href="' . route('admin.user_details', $model) . '"/><i class="fa fa-eye text-light"></i></a>';
                $html .= '<a title="Change password" class="btn btn-secondary btn-sm btn_change_password" href="' . route('admin.change_password', $model) . '"/><i class="fa fa-key text-dark"></i></a>';
                return $html;
            })
            ->editColumn('created_at', function (User $model) {
                return date_format_custom($model->created_at, 'd M, Y');
            })
            ->editColumn('user_type', function (User $model) {
                return ucwords(str_remove_dashes_custom($model->user_type));
            })
            ->editColumn('banned', function (User $model) {
                $html = '';
                if ($model->banned) {
                    $html = '<span class="badge badge-secondary">Inactive</span>';
                } else {
                    $html = '<span class="badge badge-success">Active</span>';
                }
                return $html;
            })


            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'banned'])
            ->toJson();
    }
}
