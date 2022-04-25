<?php

use App\Admin\Controllers\ApplicationBankController;
use App\Admin\Controllers\TransactionDirectionTypeController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('application-banks', ApplicationBankController::class);
    $router->resource('transaction-direction-types', TransactionDirectionTypeController::class);
});
