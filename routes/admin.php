<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    #################################### Begin Language Route #######################################
    Route::group(['prefix' => 'languages'], function (){
        Route::get('/', [App\Http\Controllers\admin\LanguagesController::class, 'index'])->name('admin.languages');
        Route::get('create', [App\Http\Controllers\admin\LanguagesController::class, 'create'])->name('admin.languages.create');
        Route::post('store', [App\Http\Controllers\admin\LanguagesController::class, 'store'])->name('admin.languages.store');

        Route::get('edit/{id}', [App\Http\Controllers\admin\LanguagesController::class, 'edit'])->name('admin.languages.edit');
        Route::post('update/{id}', [App\Http\Controllers\admin\LanguagesController::class, 'update'])->name('admin.languages.update');


        Route::get('delete/{id}', [App\Http\Controllers\admin\LanguagesController::class, 'destroy'])->name('admin.languages.delete');
    });
    #################################### End   Language Route #######################################
    #################################### Begin Main Categories Route #######################################
    Route::group(['prefix' => 'main_categories'], function (){
        Route::get('/', [\App\Http\Controllers\admin\MainCategoriesController::class, 'index'])->name('admin.maincategories');
        Route::get('create', [\App\Http\Controllers\admin\MainCategoriesController::class, 'create'])->name('admin.maincategories.create');
        Route::post('store', [\App\Http\Controllers\admin\MainCategoriesController::class, 'store'])->name('admin.maincategories.store');

        Route::get('edit/{id}', [\App\Http\Controllers\admin\MainCategoriesController::class, 'edit'])->name('admin.maincategories.edit');
        Route::post('update/{id}', [\App\Http\Controllers\admin\MainCategoriesController::class, 'update'])->name('admin.maincategories.update');


        Route::get('delete/{id}', [\App\Http\Controllers\admin\MainCategoriesController::class, 'destroy'])->name('admin.maincategories.destroy');
        Route::get('changeStatus/{id}', [\App\Http\Controllers\admin\MainCategoriesController::class, 'changeStatus'])->name('admin.maincategories.status');
    });
    #################################### End   Main Categories Route #######################################
    #################################### Begin Vendors Route #######################################
    Route::group(['prefix' => 'vendors'], function (){
        Route::get('/', [\App\Http\Controllers\admin\VendorController::class, 'index'])->name('admin.vendors');
        Route::get('create', [\App\Http\Controllers\admin\VendorController::class, 'create'])->name('admin.vendors.create');
        Route::post('store', [\App\Http\Controllers\admin\VendorController::class, 'store'])->name('admin.vendors.store');

        Route::get('edit/{id}', [\App\Http\Controllers\admin\VendorController::class, 'edit'])->name('admin.vendors.edit');
        Route::post('update/{id}', [\App\Http\Controllers\admin\VendorController::class, 'update'])->name('admin.vendors.update');


        Route::get('delete/{id}', [\App\Http\Controllers\admin\VendorController::class, 'destroy'])->name('admin.vendors.delete');
        Route::get('changeStatus/{id}', [\App\Http\Controllers\admin\VendorController::class, 'changeStatus'])->name('admin.vendors.status');
    });
    #################################### End   Vendors Route #######################################

});



Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function(){
    Route::get('login', [App\Http\Controllers\Admin\LoginController::class, 'getLogin'])->name('get.admin.login');
    Route::post('login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
});

Route::get('test-helper', function () {

    return show_name();
});
