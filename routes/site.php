<?php

use App\Http\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', HomeComponent::class)->name('index');
Route::get('/shop', \App\Http\Livewire\ShopComponent::class);
Route::get('/cart', \App\Http\Livewire\CartComponent::class)->name('product.cart');
//Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.');
Route::get('/checkout', \App\Http\Livewire\CheckoutComponent::class)->name('checkout');
Route::get('/product/{slug}', \App\Http\Livewire\DetaillsComponent::class)->name('product.details');
Route::get('/product-category/{category_slug}', \App\Http\Livewire\CategoryComponent::class)->name('product.category');
Route::get('/home-category', \App\Http\Livewire\Admin\AdminHomeCategoryComponent::class)->name('admin.homecategories');
Route::get('/search', \App\Http\Livewire\SearchComponent::class)->name('product.search');
Route::get('/search', \App\Http\Livewire\SearchComponent::class)->name('product.search');
Route::get('/wishlist', \App\Http\Livewire\WishListComponent::class)->name('product.wishlist');
//Route::delete('/coupon', [\App\Http\Controllers\CouponsController::class, 'destroy'])->name('coupons.destroy');
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/home-categories/create', \App\Http\Livewire\Admin\AdminHomeCategoryComponent::class)->name('home-categories.create');
    Route::get('/sale', \App\Http\Livewire\Admin\AdminSaleComponent::class)->name('admin.sale');
    //Route::get('/coupon', \App\Http\Livewire\Admin\AdminCouponsComponent::class)->name('admin.coupons');
    //Route::get('/coupon/add', \App\Http\Livewire\Admin\AdminAddCouponComponent::class)->name('admin.addcoupons');
    //Route::post('/coupon/edit', \App\Http\Livewire\Admin\AdminEditCouponComponent::class)->name('admin.editcoupons');

});


//For Admin
//Route::middleware(['auth:sanctum', 'verified'])->group(function(){
//    Route::get('/admin/login', \App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('admin.login');
//    Route::get('/admin/categories', \App\Http\Livewire\Admin\AdminCategoryComponent::class)->name('admin.categories');
//});

#################################### Begin Products Route #######################################
/*Route::group(['prefix' => 'admin/homeslider'], function (){
    Route::get('/', AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('create', \App\Http\Livewire\Admin\AdminAddHomeSliderComponent::class)->name('admin.homeslider.create');
    //Route::post('store', [\App\Http\Controllers\admin\ProductController::class, 'store'])->name('admin.homeslider.store');

    Route::get('edit/{slide_id}', \App\Http\Livewire\Admin\AdminEditHomeSliderComponent::class)->name('admin.homeslider.edit');

//        /* Route::post('update/{id}', [\App\Http\Controllers\admin\ProductController::class, 'update'])->name('admin.products.update');
//
//
//         Route::get('delete/{id}', [\App\Http\Controllers\admin\ProductController::class, 'destroy'])->name('admin.products.delete');
//         Route::get('changeStatus/{id}', [\App\Http\Controllers\admin\ProductController::class, 'changeStatus'])->name('admin.products.status');*/
    //});
    #################################### End   Vendors Route #######################################

