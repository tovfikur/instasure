<?php

namespace App\Http\Controllers\CollectionCenter;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CollectionCenter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{

    /**
     * List of all table total row counting
     * @return view
     */
    public function index()
    {
        $counts = DB::select("SELECT
        (SELECT COUNT(*) FROM collection_centers) as collection_centers,
        (SELECT COUNT(*) FROM users) as users
        ");
        $counts = collect($counts[0]);


        $styles = [
            ['icon' => 'fa fa-code-branch', 'bg' => 'bg-primary', 'route' => ''],
            ['icon' => 'fa fa-rss-square', 'bg' => 'bg-warning', 'route' => ''],
            ['icon' => 'fa fa-university', 'bg' => 'bg-danger', 'route' => ''],
            ['icon' => 'fa fa-bookmark', 'bg' => 'bg-info', 'route' => ''],
            ['icon' => 'fa fa-money', 'bg' => 'bg-primary', 'route' => ''],
            ['icon' => 'fa fa-users', 'bg' => 'bg-warning', 'route' => ''],
            ['icon' => 'fa fa-code-branch', 'bg' => 'bg-danger', 'route' => ''],
            ['icon' => 'fa fa-question', 'bg' => 'bg-info', 'route' => ''],
            ['icon' => 'fa fa-wrench', 'bg' => 'bg-primary', 'route' => ''],
            ['icon' => 'fa fa-phone-square', 'bg' => 'bg-warning', 'route' => ''],
            ['icon' => 'fa fa-sitemap', 'bg' => 'bg-danger', 'route' => ''],
            ['icon' => 'fa fa-mobile', 'bg' => 'bg-info', 'route' => ''],
            ['icon' => 'fa fa-gift', 'bg' => 'bg-primary', 'route' => ''],
            ['icon' => 'fa fa-object-group', 'bg' => 'bg-warning', 'route' => ''],
            ['icon' => 'fa fa-envelope', 'bg' => 'bg-danger', 'route' => ''],
            ['icon' => 'fa fa-users', 'bg' => 'bg-info', 'route' => ''],
            ['icon' => 'fa fa-bookmark', 'bg' => 'bg-primary', 'route' => ''],
            ['icon' => 'fa fa-money', 'bg' => 'bg-warning', 'route' => ''],
            ['icon' => 'fa fa-podcast', 'bg' => 'bg-danger', 'route' => ''],
            ['icon' => 'fa fa-film', 'bg' => 'bg-info', 'route' => ''],
            ['icon' => 'fa fa-plane', 'bg' => 'bg-primary', 'route' => ''],
            ['icon' => 'fa fa-paper-plane', 'bg' => 'bg-warning', 'route' => ''],
            ['icon' => 'fa fa-users', 'bg' => 'bg-danger', 'route' => ''],
            ['icon' => 'fa fa-star', 'bg' => 'bg-info', 'route' => ''],
        ];

        return view('backend.collection_center.dashboard.dashboard', compact('counts', 'styles'));
    }

    /**
     * Logged in user profile
     * @return
     */

    public function profile()
    {

        $user = CollectionCenter::with(['user', 'parent_dealer', 'division', 'district', 'upazila'])->where('user_id', Auth::id())->first();

        return view('backend.collection_center.dashboard.profile', compact('user'));
    }
    /**
     * Logged in user information update
     * @parem Request $request
     * @return response json
     */

    public function update_profile(Request $request)
    {

        ## Validate incoming request data ##
        $this->validate($request, [
            'name'                                      => 'required|max:50',
            'phone'                                     => [
                'required',
                'regex:/(01)[0-9]{9}/',
                Rule::unique('users')->ignore($request->id, 'id')
            ],
            'email'                                     => 'sometimes|nullable|email|max:50',
            'password'                                  => 'sometimes|nullable|min:6',
            "contact_person_name"                       => 'required|max:50',
            "contact_person_phone"                      => 'required|max:11',
            "contact_person_email"                      => 'sometimes|nullable|email|max:50',
            "address"                                   => 'required',
        ]);

        $collection_center = CollectionCenter::with(['user'])->find($request->collection_center_id);
        try {
            ## Find and update collection center informations ##
            $collection_center->contact_person_name     = $request->contact_person_name;
            $collection_center->contact_person_phone    = $request->contact_person_phone;
            $collection_center->contact_person_email    = $request->contact_person_email ?? $collection_center->contact_person_email;
            $collection_center->address                 = $request->address;
            $collection_center->save();

            ## Update user informations ##
            $collection_center->user->name              = $request->name;
            $collection_center->user->phone             = $request->phone;
            $collection_center->user->email             = $request->email ?  $request->email : ($collection_center->user->email ? $collection_center->user->email : $request->contact_person_email);

            ## Update password if available
            if ($request->password) {
                $collection_center->user->password      = Hash::make($request->password);
            }
            $collection_center->user->save();


            ## Return json response
            return response()->json(['success' => true, 'message' => 'Successfully updated']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Failed: Something went wrong']);
        }
    }
}
