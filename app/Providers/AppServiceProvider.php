<?php

namespace App\Providers;

use App\Service\Contracts\TraderServiceInterface;
use App\Service\TraderService;
use App\Support\HttpClient\HttpClientProvider;
use App\Support\HttpClient\Providers\GuzzleProvider;
use App\Support\Sso\Providers\KeycloakProvider;
use App\Support\Sso\Providers\QAKeycloakProvider;
use App\Support\Sso\SsoProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TraderServiceInterface::class, function () {
            $providerClass = TraderService::class;

            return new $providerClass(
                new GuzzleProvider(
                    config('daazweb.api_url') . '/',
                    [
                        'Authorization' => 'Bearer ' . config('daazweb.api_token')
                    ]
                )
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
