<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function get_related_post()
    {
        // return 12345;
        return Blog::with('category')->where(['type' => $this->type, 'status' => true])->get();
    }

    /**
     * Relationship
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
