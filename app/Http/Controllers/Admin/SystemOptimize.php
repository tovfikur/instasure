<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SystemOptimize extends Controller
{
    function __construct()
    {
        $this->middleware('permission:system-optimize-config-cache', ['only' => ['ConfigCache']]);
        $this->middleware('permission:system-optimize-cache-clear', ['only' => ['CacheClear']]);
        $this->middleware('permission:system-optimize-view-clear', ['only' => ['ViewClear']]);
        $this->middleware('permission:system-optimize-view-cache', ['only' => ['ViewCache']]);
        $this->middleware('permission:system-optimize-route-clear', ['only' => ['RouteClear']]);
        $this->middleware('permission:system-optimize-route-cache', ['only' => ['RouteCache']]);
        $this->middleware('permission:system-optimize-settings', ['only' => ['Settings']]);
    }
    public function ConfigCache()
    {
        $exitCode = Artisan::call('config:cache');
        //dd($exitCode);
        //Toastr::success('Site Optimized Successfully Done!');
        return 1;
    }
    public function CacheClear()
    {
        $exitCode = Artisan::call('cache:clear');
        Toastr::success('Cache Clear Successfully Done!');
        return back();
    }
    public function ViewClear()
    {
        $exitCode = Artisan::call('view:clear');
        Toastr::success('View Clear Successfully Done!');
        return back();
    }
    public function ViewCache()
    {
        $exitCode = Artisan::call('view:cache');
        Toastr::success('View Optimized Successfully Done!');
        return back();
    }
    public function RouteClear()
    {
        $exitCode = Artisan::call('route:clear');
        Toastr::success('Route Clear Successfully Done!');
        return back();
    }
    public function RouteCache()
    {
        $exitCode = Artisan::call('route:cache');
        Toastr::success('Route Clear Successfully Done!');
        return back();
    }
    public function Settings()
    {
        return view('backend.admin.settings');
    }
}
