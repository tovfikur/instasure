<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class BlogCategory extends Model
{
    protected $fillable = ['name', 'slug', 'status'];
    /**
     * Relations
     *
     */

     public function posts(){
         return $this->hasMany(Blog::class);
     }

    /**
     * Claim payment request ajax request
     *
     */

    public static function ajax()
    {

        $query = BlogCategory::query();


        return Datatables::of($query)
            ->addColumn('actions', function (BlogCategory $model) {
                $html = '<a id="blog_category_edit_btn" href="' . route('admin.blog-categories.edit', [$model]) . '" class="mr-2" title="Edit"><span class="badge badge-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>';
                $html .= '<a id="blog_category_delete_btn" href="' . route('admin.blog-categories.delete', [$model]) . '" title="Delete"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>';
                return $html;
            })
            ->editColumn('name', function (BlogCategory $model) {
                return ucfirst($model->name);
            })
            ->editColumn('created_at', function (BlogCategory $model) {
                return dateFormat($model->created_at);
            })
            ->editColumn('status', function (BlogCategory $model) {
                $html = '';
                if ($model->status == 1) {
                    $html .=  '<span class="badge badge-success">Active</span>';
                } else {
                    $html .= '<span class="badge badge-secondary">Inactive</span>';
                }
                return $html;
            })
            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'status'])
            ->toJson();
    }
}
