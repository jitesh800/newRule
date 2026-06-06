<?php

use Illuminate\Support\Facades\Route;
use Modules\PriceRule\Http\Controllers\HomeController;
use Modules\PriceRule\Http\Controllers\PriceRuleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('pricerule')->name('pricerule.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

// HomeController will be generated automatically by the module generator 



/*
|--------------------------------------------------------------------------
| Price Rule Module Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['web'])
    ->prefix('admin/price-rules')
    ->name('admin.price-rules.')
    ->group(function () {
        Route::get('/', [PriceRuleController::class, 'index'])->name('index');
        Route::get('/create', [PriceRuleController::class, 'create'])->name('create');
        Route::post('/', [PriceRuleController::class, 'store'])->name('store');

        Route::get('/{priceRule}', [PriceRuleController::class, 'show'])->name('show');
        Route::get('/{priceRule}/edit', [PriceRuleController::class, 'edit'])->name('edit');
        Route::put('/{priceRule}', [PriceRuleController::class, 'update'])->name('update');
        Route::delete('/{priceRule}', [PriceRuleController::class, 'destroy'])->name('destroy');
    });