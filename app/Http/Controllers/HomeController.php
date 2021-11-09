<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->get();

        $role_user = auth()->user()->roles()->pluck('name')->first();
        // // Permissions inherited from the user's roles
        // $user = auth()->user();
        // $data_via = $user->getPermissionsViaRoles()->pluck('name');
        // // dd($data_via);

        return view('home', ['users' => $users]);
    }
}
