<?php

use App\Admin\Controllers\CodeGenController;
use App\Admin\Controllers\EmployeesController;
use App\Admin\Controllers\FinancialPeriodController;
use App\Admin\Controllers\GeGenController;
use App\Admin\Controllers\PharmacyController;
use App\Admin\Controllers\PharmacyEditController;
use App\Admin\Controllers\StockCategoryController;
use App\Admin\Controllers\StockItemController;
use App\Admin\Controllers\StockRecordController;
use App\Admin\Controllers\StockSubCategoryController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('pharmacies', PharmacyController::class);
    $router->resource('stock-categories', StockCategoryController::class);
    $router->resource('stock-sub-categories', StockSubCategoryController::class);
    $router->resource('financial-periods', FinancialPeriodController::class);
    $router->resource('employees', EmployeesController::class);
    $router->resource('stock-items', StockItemController::class);
    $router->resource('stock-records', StockRecordController::class);
    $router->resource('pharmacies-edit', PharmacyEditController::class);
    $router->resource('gens', CodeGenController::class);
    $router->resource('gen', GeGenController::class);

});
