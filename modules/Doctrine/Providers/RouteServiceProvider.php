<?php

namespace Modules\Doctrine\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected string $moduleNamespace = 'Modules\Doctrine\Http\V1\Controller';

    public function boot(): void
    {
        parent::boot();
    }

    public function map(): void
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes(): void
    {
        //admin routes
        Route::prefix('api')
            ->name('admin')
            ->group(module_path('Doctrine', '/routes.php'));
    }
}
