<?php

namespace Modules\Doctrine\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Doctrine\Infrastructure\Doctrine\Flusher;
use Modules\Doctrine\Infrastructure\Doctrine\Flusher;
use Modules\Doctrine\Src\Contracts\ProductServiceContract;
use Modules\Doctrine\App\Service\ProductService;
use Modules\Doctrine\Src\Repository\CategoryRepository;
use Modules\Doctrine\Src\Repository\Interfaces\CategoryRepositoryInterface;
use Modules\Doctrine\Src\Repository\Interfaces\ProductCategoryRepositoryInterface;
use Modules\Doctrine\Src\Repository\Interfaces\ProductDescriptionRepositoryInterface;
use Modules\Doctrine\Src\Repository\Interfaces\ProductRepositoryInterface;
use Modules\Doctrine\Src\Repository\ProductCategoryRepository;
use Modules\Doctrine\Src\Repository\ProductDescriptionRepository;
use Modules\Doctrine\Src\Repository\ProductRepository;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Doctrine';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'doctrine';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerRepositories();
        $this->registerCommands();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migration'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(
            ProductServiceContract::class,
            ProductService::class
        );
        $this->app->bind(
            Flusher::class,
            Flusher::class
        );
    }

    protected function registerConfig(): void
    {
    }

    protected function registerRepositories(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
        $this->app->bind(
            ProductDescriptionRepositoryInterface::class,
            ProductDescriptionRepository::class
        );
        $this->app->bind(
            ProductCategoryRepositoryInterface::class,
            ProductCategoryRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
    }

    protected function registerCommands(): void
    {
    }

    public function provides(): array
    {
        return [];
    }
}
