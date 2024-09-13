<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        \Debugbar::enable();

//        cache()->flush();
//        cache()->forget('topUsers');

        if (!Schema::hasTable('users')) {
            return;
        }

        $topUsers = Cache::remember('topUsers', now()->addMinute(), function () {
            return User::withCount('ideas')
                ->orderBy('ideas_count', 'DESC')
                ->limit(5)
                ->get();
        });

        View::share('topUsers', $topUsers);
    }
}
