<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $roles = Role::all();
        $users = User::with('role')->paginate(3);
        return view('admin.users', compact('users','roles'));
    }


}
