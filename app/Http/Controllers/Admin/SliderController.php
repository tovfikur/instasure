<?php

namespace App\Http\Controllers\Admin;

use App\Model\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:sliders-list', ['only' => ['index']]);
        $this->middleware('permission:sliders-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sliders-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sliders-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('backend.admin.sliders.create');
    }

    /**
     * Store slider image
     * @param Illuminate\Http\Request $request
     * @return redirect back
     */

    public function store(Request $request)
    {
        ## Validate
        $request->validate([
            'title'             => ['required'],
            'content'           => ['required'],
            'image'             => ['required', 'file', 'mimes:jpeg,jpg,png', 'dimensions:width=1920,height=1080', 'max:300'],
        ]);

        ## Create new slider model
        $slider                 = new Slider();
        $image                  = $request->file('image');
        if (isset($image)) {
            $slider->image      = $image->store('uploads/sliders');
        }
        $slider->title          = $request->title;
        $slider->content        = $request->content;

        $slider->save();
        Toastr::success('Slider Created Successfully');
        return back();
    }

    public function show($id)
    {
        //
    }

    /**
     * Edit slider image
     * @param App\Model\Slider $id
     * @return View view
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('backend.admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        ## Validate
        $request->validate([
            'title'             => ['required'],
            'content'           => ['required'],
            'image'             => ['sometimes', 'required', 'file', 'mimes:jpeg,jpg,png', 'dimensions:width=1920,height=1080', 'max:300'],
        ]);
        $slider =  Slider::find($id);
        $image = $request->file('image');
        $imagename = null;
        if (isset($image)) {

            ## Delete existing image
            if ($slider->image) {
                $image_path = public_path('/') . $slider->image;
                $this->delete_file($image_path);
            }
            $imagename = $image->store('uploads/sliders');
        } else {
            $imagename = $slider->image;
        }
        $slider->image = $imagename;
        $slider->title = $request->title;
        $slider->content = $request->content;

        $slider->save();
        Toastr::success('Slider Updated Successfully');
        return redirect()->route('admin.sliders.index');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        ## Delete existing image
        if ($slider->image) {
            $image_path = public_path('/') . $slider->image;
            $this->delete_file($image_path);
        }
        $slider->delete();
        Toastr::success('Sliders Deleted Successfully');
        return back();
    }


    /**
     * Delete exist file if exist
     * @param File $image_path
     * @return boolean true|false
     */
    public function delete_file($image_path)
    {
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
    }
}
