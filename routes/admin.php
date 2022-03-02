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
        Route::get('/', [App\Http\Controllers\admin\LanguagesController::class])->name('admin.languages');
    });
    #################################### End   Language Route #######################################

});



Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function(){
    Route::get('login', [App\Http\Controllers\Admin\LoginController::class, 'getLogin'])->name('get.admin.login');
    Route::post('login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
});

