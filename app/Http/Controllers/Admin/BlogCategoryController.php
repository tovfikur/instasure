<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Model\BlogCategory;
use App\Model\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryStoreRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;

class BlogCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:blog-cat-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:blog-cat-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog-cat-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blog-cat-delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.blog_categories.index');
    }
    /**
     * Display a listing of the resource usign ajax request
     *
     * @return \Illuminate\Http\Response
     */
    public function index_ajax()
    {

        return BlogCategory::ajax();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.blog_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryStoreRequest $request)
    {
        $inputs = $request->only(['name', 'slug', 'status']);
        $inputs['slug'] = Str::slug($request->slug, '-');
        $new_model = BlogCategory::create($inputs);
        if ($new_model) {
            return response()->json(['status' => 'success',  'message' => 'Created Successfully']);
        } else {
            return response()->json(['error' => 'failed', 'message' => 'Creation Faild']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('backend.admin.blog_categories.edit', ['model' => $blogCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, BlogCategory $blogCategory)
    {
        $inputs = $request->only(['name', 'slug', 'status']);
        $inputs['slug'] = Str::slug($request->slug, '-');
        $new_model = $blogCategory->update($inputs);
        if ($new_model) {
            return response()->json(['status' => 'success',  'message' => 'Updated Successfully']);
        } else {
            return response()->json(['error' => 'failed', 'message' => 'Update Faild']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return response()->json(['success' => true, 'message' => 'Deleted successfully']);
    }
    public function delete(BlogCategory $blogCategory)
    {

        $blogCategory->delete();
        return response()->json(['success' => true, 'message' => 'Deleted successfully']);
    }
}
