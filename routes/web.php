<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Toko;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\CouriersController;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});
Auth::routes(['verify'=>true]);


Route::middleware(['guest:web'])->group(function(){
    Route::get('login',[Login::class,'login'])->name('login');
    Route::get('register',[Login::class,'register'])->name('register');
    Route::post('registers_proses',[Login::class,'proses_register'])->name('register_proses');
    Route::post('logins_proses',[Login::class,'proses_login'])->name('login_proses');
});

Route::middleware(['auth:web'])->group(function(){
    // Route::view('home','user.home')->middleware('verified')->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');

    Route::view('profile',[Login::class,'profile'])->name('profile');
    Route::post('/logout',[Login::class,'logout'])->name('logout');
    // route::get('toko',[Toko::class,'toko'])->name('home');
});


Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware(['guest:admin'])->group(function(){
            Route::get('login',[Admin::class,'login'])->name('login');
            Route::post('logins_proses',[Admin::class,'proses_login'])->name('login_proses');
        });
        Route::middleware(['auth:admin'])->group(function(){
            Route::view('home','admin.home')->name('home');

            //admin management
            Route::get('/admin-management', [AdminManagementController::class, 'index'])->name('management.index');
            Route::get('/admin-management/add', [AdminManagementController::class, 'create'])->name('management.add');
            Route::post('/admin-management/store', [AdminManagementController::class, 'store'])->name('management.store');
            Route::get('/admin-management/delete-{id}', [AdminManagementController::class, 'destroy'])->name('management.delete');
            Route::get('/admin-management/edit-{id}', [AdminManagementController::class, 'edit'])->name('management.edit');
            Route::post('/admin-management/update-{id}', [AdminManagementController::class, 'update'])->name('management.update');



            //product
            Route::get('/list-product', [ProductController::class, 'index'])->name('product-list');
            Route::get('/add-product', [ProductController::class, 'create']);
            Route::post('/list-product', [ProductController::class, 'store']);
            Route::get('/product/{id}/detail', [ProductController::class, 'show'])->name('product-detail');
            Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product-edit');
            Route::post('/product/{id}', [ProductController::class, 'update'])->name('product-update');
            Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product-delete');
            Route::get('/product/trash', [ProductController::class, 'trash']);
            Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name('product-restore');
            Route::get('/product/restore', [ProductController::class, 'restore_all'])->name('product-restoreall');
            Route::get('/product/delete_permanently/{id}', [ProductController::class, 'delete'])->name('product-deletepmt');
            Route::get('/product/delete_permanently', [ProductController::class, 'delete_all'])->name('product-deletepmtall');
            //productImages
            Route::post('/productimage/add', [ProductImageController::class, 'store'])->name('productImages-store');
            Route::post('/productimage/delete/{id}', [ProductImageController::class, 'destroy'])->name('productImages-destroy');
            //discount
            Route::get('/list-discount', [DiscountController::class, 'index'])->name('discount-list');
            Route::get('/add-discount', [DiscountController::class, 'create']);
            Route::post('/list-discount', [DiscountController::class, 'store']);
            Route::get('/discount/{id}/edit', [DiscountController::class, 'edit'])->name('discount-edit');
            Route::post('/discount/{id}', [DiscountController::class, 'update'])->name('discount-update');
            Route::delete('/discount/{id}', [DiscountController::class, 'destroy']);
            Route::post('/logout',[Admin::class,'logout'])->name('logout');
            // route::get('toko',[Toko::class,'toko'])->name('home');

            //productCategory
            Route::get('product-category',[ProductCategoryController::class,'index'])->name('product-category.index');
            Route::get('product-category/create',[ProductCategoryController::class,'create'])->name('product-category.create');
            Route::post('product-category-store', [ProductCategoryController::class,'store']);
            Route::get('product-category/{id}/edit', [ProductCategoryController::class, 'edit'])->name('product-category.edit');
            Route::post('product-category/{id}/update',[ ProductCategoryController::class,'update']);
            Route::delete('product-category/{id}/delete', [ProductCategoryController::class, 'delete'])->name('product-category.delete');

            //couriers
            Route::get('couriers', [CouriersController::class, 'index'])->name('couriers.index');
            Route::get('couriers/create',[CouriersController::class,'create'])->name('couriers.create');
            Route::post('couriers-store', [CouriersController::class,'store']);
            Route::get('couriers/{id}/edit', [CouriersController::class, 'edit'])->name('couriers.edit');
            Route::post('couriers/{id}/update',[ CouriersController::class,'update']);
            Route::delete('couriers/{id}/delete', [CouriersController::class, 'delete'])->name('couriers.delete');

        });

});










