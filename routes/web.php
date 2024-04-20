<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteRestaurantController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;




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




   


Route::prefix('managers')->group(function () {
    
   
    Route::get('/dashboard', [ManagerController::class, 'dashboard'])->middleware('auth:managers')->name('dashboard');
    Route::post('/managers/managerupdate/{id}', [ManagerController::class, 'managerupdate'])->name('managerupdate');
    Route::post('/afterqr/{id}', [ManagerController::class, 'checkQR'])->name('checkQR');
    Route::post('Managerlogout', [ManagerController::class, 'Managerlogout'])->name('manager.logout');


});

Route::prefix('superadmins')->group(function () {
    
   
    Route::get('/', [AdminController::class, 'superadmins'])->middleware('auth:sueradmins')->name('superadmins');
    Route::post('/superadminCreate', [AdminController::class, 'superadminCreate'])->name('superadminCreate');
    Route::post('/superadminEdit', [AdminController::class, 'superadminEdit'])->name('superadminEdit');
    Route::post('/', [AdminController::class, 'superadminDelete'])->name('superadminDelete');



});







Route::middleware('auth')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/payment', [ShopController::class, 'payment'])->name('payment');


    Route::post('/paymentstore', [ShopController::class, 'paymentstore'])->name('paymentstore');
Route::get('/mypage', [ShopController::class, 'mypage'])->name('mypage');
Route::post('/mypage/{id}', [ShopController::class, 'showReviewForm'])->name('reserve.review');
Route::get('/search', [ShopController::class, 'search']); 
Route::post('/search', [ShopController::class, 'search']); 
Route::get('/detail/{restaurant}', [ShopController::class, 'detail']);
Route::post('/reserve', [ShopController::class, 'reserve'])->name('reserve');
Route::post('/update', [ShopController::class, 'update'])->name('update');
Route::get('/thanksreserve', [ShopController::class, 'thanksreserve'])->name('thanksreserve');

Route::post('/storerestau', [FavoriteRestaurantController::class, 'storerestau'])->name('storerestau');
Route::delete('destroy/', [FavoriteRestaurantController::class, 'destroy'])->name('destroy');
Route::post('detail', [ShopController::class, 'storage'])->name('storage');




Route::post('/upload', [ShopController::class, 'upload'])->middleware('auth');
});


    
require __DIR__.'/auth.php';
