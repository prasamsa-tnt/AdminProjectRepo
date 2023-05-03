<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\FirebaseService;
use App\Observers\UserFavouriteObserver;
class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('FirebaseService', function () {
            return new FirebaseService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
