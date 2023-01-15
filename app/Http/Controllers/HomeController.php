<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * @var $user
     */
    public $user;

    /**
     * Create a new controller instance.
     * @params User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = $this->user->all();

        return view('home', compact('users'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addUser()
    {
        $roles = Role::all();

        return view('add_user', compact('roles'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editUser(User $user)
    {
        $roles = Role::all();
        $user_role = $user->getRoleNames()->first();

        return view('edit_user', compact('user', 'roles', 'user_role'));
    }
}
