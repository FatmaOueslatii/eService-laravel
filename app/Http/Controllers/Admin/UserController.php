<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Facades\Activity;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $roleFilter = $request->input('role');

        $users = User::query()
            ->with('roles') // Spatie
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($roleFilter, function ($query, $roleFilter) {
                $query->role($roleFilter);   // ✔ Spatie scope
            })
            ->orderBy('name')
            ->get();

        $roles = \Spatie\Permission\Models\Role::all();

        return view('admin.users', compact('users', 'roles', 'search', 'roleFilter'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.users.create', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required', 'string'],
        ]);

        $user = User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->assignRole($validatedData['role']);

        // Log
        activity()
            ->causedBy(auth()->user())
            ->on($user)
            ->withProperties(['email' => $user->email])
            ->log('Nouvel utilisateur créé');

        return redirect()->route('admin.users.index')
            ->with('toast', ['type' => 'success', 'message' => 'Utilisateur créé avec succès.']);
    }




    /**
     * Display the specified resource.
     */
//    public function show(User $user)
//    {
//        return view('admin.users.show', compact('user'));
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role'  => 'required|string',
        ]);

        // Mise à jour propre
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);
        activity()
            ->causedBy(auth()->user())
            ->on($user)
            ->withProperties(['email' => $user->email])
            ->log('Utilisateur mis à jour');

        return redirect()->route('admin.users.index')
            ->with('toast', ['type' => 'success', 'message' => 'Utilisateur mis à jour avec succès.']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->on($user)
            ->withProperties(['email' => $user->email])
            ->log('Utilisateur supprimé');

        $user->delete();
        return redirect()
            ->route('admin.users.index')
            ->with('toast', ['type' => 'success', 'message' => 'Utilisateur supprimé.']);
    }


}
