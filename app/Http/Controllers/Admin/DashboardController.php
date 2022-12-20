<?php

namespace App\Http\Controllers\Admin;


use App\Model\Blog;
use App\Model\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Dealer;
use App\Model\DueBalanceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:dashboard', ['only' => ['index']]);
    }
    /**
     * List of all table total row counting
     * @return view
     */
    public function index()
    {
        $counts = DB::select("SELECT
        (SELECT COUNT(*) FROM blog_categories) as blog_categories,
        (SELECT COUNT(*) FROM blogs) as blogs,
        (SELECT COUNT(*) FROM brands) as brands,
        (SELECT COUNT(*) FROM categories) as insurance_categories,
        (SELECT COUNT(*) FROM claim_payment_requests) as device_service_request,
        (SELECT COUNT(*) FROM dealers) as dealers,
        (SELECT COUNT(*) FROM device_categories) as device_categories,
        (SELECT COUNT(*) FROM device_claims) as device_claims,
        (SELECT COUNT(*) FROM device_insurances) as device_insurances,
        (SELECT COUNT(*) FROM device_models) as device_models,
        (SELECT COUNT(*) FROM device_subcategories) as device_subcategories,
        (SELECT COUNT(*) FROM 	imei_datas) as 	imei_datas,
        (SELECT COUNT(*) FROM insurance_packages) as insurance_packages,
        (SELECT COUNT(*) FROM insurance_types) as insurance_types,
        (SELECT COUNT(*) FROM messages) as messages,
        (SELECT COUNT(*) FROM partners) as partners,
        (SELECT COUNT(*) FROM parts) as parts,
        (SELECT COUNT(*) FROM payment_request_to_admins) as service_charge_withdraw_request,
        (SELECT COUNT(*) FROM policy_providers) as policy_providers,
        (SELECT COUNT(*) FROM sliders) as sliders,
        (SELECT COUNT(*) FROM travel_ins_orders) as travel_ins_orders,
        (SELECT COUNT(*) FROM travel_ins_plans_categories) as travel_ins_plans_categories,
        (SELECT COUNT(*) FROM users) as users
        ");
        $counts = collect($counts[0]);

        ## Parent due balance
        $parentDueBalance = Dealer::sum('due_balance');


        ## Parent due balance
        $dueBalanceCollection = DueBalanceCollection::sum('collected_amount');

        ## Style
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

        return view('backend.admin.dashboard', compact('counts', 'styles', 'parentDueBalance', 'dueBalanceCollection'));
    }

    /**
     * List of all users including, admin, parent dealer, child dealer, customer, service centers, collection centers
     * @return
     */

    public function users()
    {
        $users = User::get();
        return view('backend.admin.users.index', compact('users'));
    }

    /**
     * List of all users using ajax call
     * @return ajax response
     */

    public function users_ajax()
    {
        return User::users_ajax();
    }
    /**
     * User details
     * @param User $user
     * @return view with user details
     */

    public function user_details(User $user)
    {
        return view('backend.admin.users.user_details_modal', compact('user'));
    }
    /**
     * Change user password
     * @param User $user
     * @return view user password change modal form
     */

    public function change_password(User $user)
    {
        return view('backend.admin.users.change_password_modal', compact('user'));
    }
    /**
     * Change user password using ajax
     * @param Request $request
     * @param User $user
     * @return response json
     */

    public function change_password_ajax(Request $request, User $user)
    {
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['success' => true, 'message' => 'Successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Faild']);
        }
    }
}
