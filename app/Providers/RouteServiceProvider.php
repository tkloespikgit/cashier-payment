<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $namespaceAdmin = 'App\Http\Controllers\Admin';
    protected $namespaceAPI = 'App\Http\Controllers\API';
    protected $namespaceCashier = 'App\Http\Controllers\Cashier';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();
        $this->mapCashierRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::domain(config('domain.user'))
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::domain(config('domain.api'))
            ->middleware('api')
            ->namespace($this->namespaceAPI)
            ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::domain(config('domain.admin'))
            ->middleware('web')
            ->namespace($this->namespaceAdmin)
            ->group(base_path('routes/admin.php'));
    }


    protected function mapCashierRoutes()
    {
        Route::domain(config('domain.cashier'))
            ->middleware('web')
            ->namespace($this->namespaceCashier)
            ->group(base_path('routes/cashier.php'));
    }
}
