<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ResetController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('adminIndex');

    Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class)->names([
        'index'=>'admin_index_products',
        'show'=>'admin_show_products',
        'edit'=>'admin_edit_products',
        'update'=>'admin_update_products',
        'create'=>'admin_create_products',
        'store'=>'admin_store_products',
        'destroy'=>'admin_destroy_products',
    ]);

    Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class)->names([
        'index'=>'admin_index_categories',
        'show'=>'admin_show_categories',
        'edit'=>'admin_edit_categories',
        'update'=>'admin_update_categories',
        'create'=>'admin_create_categories',
        'store'=>'admin_store_categories',
        'destroy'=>'admin_destroy_categories',
    ]);

    Route::resource('orders', \App\Http\Controllers\Admin\OrdersController::class)->names([
        'index'=>'admin_index_orders',
        'show'=>'admin_show_orders',
        'edit'=>'admin_edit_orders',
        'update'=>'admin_update_orders',
        'create'=>'admin_create_orders',
        'store'=>'admin_store_orders',
        'destroy'=>'admin_destroy_orders',
    ]);

    Route::resource('myOrders', \App\Http\Controllers\Admin\MyOrdersController::class)->names([
        'index'=>'admin_index_myOrders',
        'show'=>'admin_show_myOrders',
    ]);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names([
        'index'=>'admin_index_users',
    ]);
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class)->names([
        'index'=>'admin_index_permissions',
    ]);
});

Route::resource('/', \App\Http\Controllers\IndexController::class)->only(['index'])->names(['index'=>'home']);

Route::resource('categories', CategoriesController::class);
Route::get('/category/{cat_name}/{product}', [ProductsController::class, 'index'])->name('indexProduct');

Route::get('/basket', [BasketController::class, 'index'])->name('indexBasket');
Route::post('/basket/add/{product}', [BasketController::class, 'add'])->name('addBasket');
Route::post('/basket/substract/{product}', [BasketController::class, 'substract'])->name('substractBasket');

Route::get('/basket/remove', [BasketController::class, 'remove'])->name('removeBasket');

Route::get('/basket/order', [BasketController::class, 'order'])->name('orderBasket');
Route::post('/basket/receive_order', [BasketController::class, 'receive_order'])->name('receive_orderBasket');

Route::get('/reset', [ResetController::class, 'reset'])->name('reset');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
