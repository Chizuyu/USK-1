<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;

class AppServiceProvider extends ServiceProvider
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
        Event::listen(Login::class, function (Login $event) {
            $user = $event->user;

            if ($user instanceof User) {
                if (! $user->hasAnyRole()) {
                    $user->assignRole('Participant');
                }

                if ($user->hasRole('Participant') && ! $user->participant()->exists()) {
                    $user->participant()->create([
                        'name' => $user->name,
                    ]);
                }
            }
        });
    }
}
