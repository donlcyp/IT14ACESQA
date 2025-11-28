<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\ProjectDocument;
use App\Models\Project;
use App\Models\Material;
use App\Models\Invoice;
use App\Models\PurchaseOrder;
use App\Models\ProjectRecord;
use App\Models\Client;
use App\Models\User;
use App\Listeners\LogAuthenticationEvents;
use App\Observers\ProjectObserver;
use App\Observers\MaterialObserver;
use App\Observers\InvoiceObserver;
use App\Observers\PurchaseOrderObserver;
use App\Observers\ProjectRecordObserver;
use App\Observers\ClientObserver;
use App\Observers\UserObserver;

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

        // Register observers for activity logging across all modules
        Project::observe(ProjectObserver::class);
        Material::observe(MaterialObserver::class);
        Invoice::observe(InvoiceObserver::class);
        PurchaseOrder::observe(PurchaseOrderObserver::class);
        ProjectRecord::observe(ProjectRecordObserver::class);
        Client::observe(ClientObserver::class);
        User::observe(UserObserver::class);
    }
}
