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

    #################################### Begin Sub Categories Route #######################################
    Route::group(['prefix' => 'Sub_categories'], function (){
        Route::get('/', [\App\Http\Controllers\admin\SubCategoriesController::class, 'index'])->name('admin.subcategories');
        Route::get('create', [\App\Http\Controllers\admin\SubCategoriesController::class, 'create'])->name('admin.subcategories.create');
        Route::post('store', [\App\Http\Controllers\admin\SubCategoriesController::class, 'store'])->name('admin.subcategories.store');

        Route::get('edit/{id}', [\App\Http\Controllers\admin\SubCategoriesController::class, 'edit'])->name('admin.subcategories.edit');
        Route::post('update/{id}', [\App\Http\Controllers\admin\SubCategoriesController::class, 'update'])->name('admin.subcategories.update');


        Route::get('delete/{id}', [\App\Http\Controllers\admin\SubCategoriesController::class, 'destroy'])->name('admin.subcategories.destroy');
        Route::get('changeStatus/{id}', [\App\Http\Controllers\admin\SubCategoriesController::class, 'changeStatus'])->name('admin.subcategories.status');
    });
    #################################### End   Sub Categories Route #######################################

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
    #################################### Begin Products Route #######################################
    Route::group(['prefix' => 'products'], function (){
        Route::get('/', [\App\Http\Controllers\admin\ProductController::class, 'index'])->name('admin.products');
        Route::get('create', [\App\Http\Controllers\admin\ProductController::class, 'create'])->name('admin.products.create');
        Route::post('store', [\App\Http\Controllers\admin\ProductController::class, 'store'])->name('admin.products.store');

        Route::get('edit/{id}', [\App\Http\Controllers\admin\ProductController::class, 'edit'])->name('admin.products.edit');
       Route::post('update/{id}', [\App\Http\Controllers\admin\ProductController::class, 'update'])->name('admin.products.update');

        Route::get('translate/{$id}', [\App\Http\Controllers\admin\ProductController::class, 'translate'])->name('admin.products.translate');
        Route::post('crate-translation', [\App\Http\Controllers\admin\ProductController::class, 'crateTranslation'])->name('admin.products.crate-translation');


        Route::get('delete/{id}', [\App\Http\Controllers\admin\ProductController::class, 'destroy'])->name('admin.products.delete');
        Route::get('changeStatus/{id}', [\App\Http\Controllers\admin\ProductController::class, 'changeStatus'])->name('admin.products.status');
    });
    #################################### End   Vendors Route #######################################
    Route::group(['prefix' => 'homeslider'], function (){
        Route::get('/', [\App\Http\Controllers\admin\HomeSliderController::class, 'index'])->name('admin.homeslider');
        Route::get('create', [\App\Http\Controllers\admin\HomeSliderController::class, 'create'])->name('admin.homeslider.create');
        Route::post('store', [\App\Http\Controllers\admin\HomeSliderController::class, 'store'])->name('admin.homeslider.store');

        //Route::get('edit/{slide_id}', \App\Http\Livewire\Admin\AdminEditHomeSliderComponent::class)->name('admin.homeslider.edit');

//        /* Route::post('update/{id}', [\App\Http\Controllers\admin\ProductController::class, 'update'])->name('admin.products.update');*/
//
         Route::get('delete/{id}', [\App\Http\Controllers\admin\HomeSliderController::class, 'destroy'])->name('admin.homeslider.delete');
         Route::get('changeStatus/{id}', [\App\Http\Controllers\admin\HomeSliderController::class, 'changeStatus'])->name('admin.homeslider.status');
    });
    #################################### Begin Products Route #######################################
    #################################### Begin Products Route #######################################

    Route::group(['prefix' => 'coupon'], function (){
        Route::get('/', [\App\Http\Controllers\admin\CouponController::class, 'index'])->name('admin.coupon');
        Route::get('create', [\App\Http\Controllers\admin\CouponController::class, 'create'])->name('admin.coupon.create');
        Route::post('store', [\App\Http\Controllers\admin\CouponController::class, 'store'])->name('admin.coupon.store');

        Route::get('edit/{id}', [\App\Http\Controllers\admin\CouponController::class, 'edit'])->name('admin.coupon.edit');

        Route::post('update/{id}', [\App\Http\Controllers\admin\CouponController::class, 'update'])->name('admin.coupon.update');

        //Route::get('delete/{id}', [\App\Http\Controllers\admin\HomeSliderController::class, 'destroy'])->name('admin.homeslider.delete');
    });

    #################################### End   Vendors Route #######################################
});




Route::get('test-helper', function () {

    return show_name();
});

//For Admin
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/admin/login', \App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('admin.login');
    Route::get('/admin/categories', \App\Http\Livewire\Admin\AdminCategoryComponent::class)->name('admin.categories');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function(){
    Route::get('login', [App\Http\Controllers\Admin\LoginController::class, 'getLogin'])->name('get.admin.login');
    Route::post('login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
});
