<?php

namespace App\Providers;

use App\Enums\UserRolesEnum;
use Illuminate\Cache\RateLimiter;
use Illuminate\Contracts\Redis\LimiterTimeoutException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
    protected $apiNamespace = 'App\Http\Controllers\Api\v1';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

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
        $this->mapRootWebRoutes();
//        Route::middleware('web')
//            ->namespace($this->namespace)
//            ->group(base_path('routes/web.php'));
    }

    /* WEB Routes*/

    protected function mapUnauthenticatedWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/shared/unauthenticated.php'));
    }

    protected function mapAuthenticatedWebRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web/shared/authenticated.php'));
    }

    protected function mapPaginationRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->prefix('pagination')
            ->group(base_path('routes/web/shared/pagination.php'));
    }

    protected function mapRootWebRoutes ()
    {
        Route::namespace($this->namespace . '\Root')
            ->middleware(['web', 'auth', 'role:' . UserRolesEnum::ROOT])
            ->group(function () {
                Route::name('ajax.root.')
                    ->prefix('ajax/root')
                    ->group(base_path('routes/web/root/ajax.php'));

                Route::name('root.')
                    ->prefix('root')
                    ->group(base_path('routes/web/root/authenticated.php'));

                Route::name('root.pagination.')
                    ->prefix('pagination/root')
                    ->group(base_path('routes/web/root/pagination.php'));
            });
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
        $apiNamespace = $this->namespace . '\Api\v1';

        $this->mapUnauthenticatedApiRoutes();
        $this->mapAuthenticatedApiRoutes();
        $this->mapPaginationApiRoutes();

        $this->mapRootApiRoutes();
        $this->mapAdminApiRoutes();
        $this->mapTreasurerApiRoutes();
        $this->mapPartnerApiRoutes();
    }

    /*API Routes*/
    protected function mapUnauthenticatedApiRoutes()
    {
        Route::middleware(['api'])
            ->namespace($this->apiNamespace)
            ->prefix('api/v1')
            ->group(base_path('routes/api/v1/shared/unauthenticated.php'));
    }

    protected function mapAuthenticatedApiRoutes()
    {
        Route::middleware(['jwt.verify', 'auth', 'verified'])
            ->namespace($this->apiNamespace)
            ->prefix('api/v1')
            ->group(base_path('routes/api/v1/shared/authenticated.php'));
    }

    protected function mapPaginationApiRoutes()
    {
        Route::middleware(['jwt.verify', 'auth', 'verified'])
            ->namespace($this->apiNamespace)
            ->prefix('api/v1/pagination')
            ->group(base_path('routes/api/v1/shared/pagination.php'));
    }

    protected function mapRootApiRoutes()
    {
        Route::namespace($this->apiNamespace . '\Root')
            ->middleware(['jwt.auth', 'role:' . UserRolesEnum::ROOT])
            ->group(function () {
                Route::name('ajax.root.')
                    ->prefix('ajax/root')
                    ->group(base_path('routes/api/v1/root/ajax.php'));

                Route::prefix('root')
                    ->group(base_path('routes/api/v1/root/authenticated.php'));

                Route::name('root.pagination.')
                    ->prefix('pagination/root')
                    ->group(base_path('routes/api/v1/root/pagination.php'));
            });
    }

    protected function mapAdminApiRoutes()
    {
        Route::namespace($this->apiNamespace . '\Admin')
            ->middleware(['jwt.verify', 'auth', 'role:' . UserRolesEnum::ADMIN])
            ->group(function () {
                Route::name('ajax.admin.')
                    ->prefix('ajax/admin')
                    ->group(base_path('routes/api/v1/admin/ajax.php'));

                Route::name('admin.')
                    ->prefix('admin')
                    ->group(base_path('routes/api/v1/admin/authenticated.php'));

                Route::name('admin.pagination.')
                    ->prefix('pagination/admin')
                    ->group(base_path('routes/api/v1/admin/pagination.php'));
            });
    }

    protected function mapTreasurerApiRoutes()
    {
        Route::namespace($this->apiNamespace . '\Root')
            ->middleware(['jwt.verify', 'auth', 'role:' . UserRolesEnum::TREASURER])
            ->group(function () {
                Route::name('ajax.treasurer.')
                    ->prefix('ajax/treasurer')
                    ->group(base_path('routes/api/v1/treasurer/ajax.php'));

                Route::name('treasurer.')
                    ->prefix('treasurer')
                    ->group(base_path('routes/api/v1/treasurer/authenticated.php'));

                Route::name('treasurer.pagination.')
                    ->prefix('pagination/treasurer')
                    ->group(base_path('routes/api/v1/treasurer/pagination.php'));
            });
    }

    protected function mapPartnerApiRoutes()
    {
        Route::namespace($this->apiNamespace . '\Root')
            ->middleware(['jwt.verify', 'auth', 'role:' . UserRolesEnum::PARTNER])
            ->group(function () {
                Route::name('ajax.partner.')
                    ->prefix('ajax/partner')
                    ->group(base_path('routes/api/v1/partner/ajax.php'));

                Route::name('partner.')
                    ->prefix('partner')
                    ->group(base_path('routes/api/v1/partner/authenticated.php'));

                Route::name('partner.pagination.')
                    ->prefix('pagination/partner')
                    ->group(base_path('routes/api/v1/partner/pagination.php'));
            });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return LimiterTimeoutException::perMinute(100)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
