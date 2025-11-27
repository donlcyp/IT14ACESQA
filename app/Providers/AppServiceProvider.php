<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\ProjectDocument;
use App\Models\Project;
use App\Listeners\LogAuthenticationEvents;
use App\Observers\ProjectObserver;

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
        // Route model binding for ProjectDocument
        Route::model('document', ProjectDocument::class);
        
        // Register event listeners for logging user authentication
        $this->app['events']->listen(Login::class, [LogAuthenticationEvents::class, 'handleLogin']);
        $this->app['events']->listen(Logout::class, [LogAuthenticationEvents::class, 'handleLogout']);

        // Register observer for Project model to handle cascading archival
        Project::observe(ProjectObserver::class);
    }
}
