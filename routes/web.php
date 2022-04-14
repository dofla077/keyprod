<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return to_route('orders');
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders');
    Route::get('{order}/products', [OrderController::class, 'products'])->name('orders.products');
    Route::post('add/products', [OrderController::class, 'addProducts'])->name('orders.products.add');
    Route::post('add/shipment', [OrderController::class, 'addShipment'])->name('orders.products.shipment');
});

Route::prefix('shipments')->group(function () {
    Route::get('/', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::post('update/tracking', [ShipmentController::class, 'tracking'])->name('shipments.tracking');
});

