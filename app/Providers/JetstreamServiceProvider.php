<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Vite::prefetch(concurrency: 3);



        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ✅ Ajoute cette partie :
        $this->redirectUsersByRole();


    }

    private function redirectUsersByRole()
    {
        \Laravel\Fortify\Fortify::authenticateUsing(function ($request) {
            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && \Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        app('events')->listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            $user = $event->user;

            \Log::info('User roles:', ['roles' => $user->roles->pluck('name')->toArray()]);

            // Utiliser hasRole() de Spatie
            if ($user->hasRole('admin')) {
                session(['url.intended' => route('admin.dashboard')]);
            } elseif ($user->hasRole('agent')) {
                session(['url.intended' => route('agent.dashboard')]);
            } else {
                session(['url.intended' => route('client.dashboard')]);
            }
        });
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
