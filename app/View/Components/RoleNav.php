<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class RoleNav extends Component
{
    public function render()
    {
        $user = Auth::user();
        $currentRoute = Route::currentRouteName();

        $role = $user->getRoleNames()->first(); // 'admin', 'agent', 'client'

        $dashboardRoute = match ($role) {
            'admin' => route('admin.dashboard'),
            'agent' => route('agent.dashboard'),
            'client' => route('client.dashboard'),
            default => route('welcome'),
        };



        return view('components.role-nav', compact('dashboardRoute', 'user','currentRoute'));
    }
}
