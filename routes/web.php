<?php

use App\Http\Controllers\AdminController;
use App\Models\Admin;
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
Route::get('/', [AdminController::class, 'getLogin'])->name('admin.login');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // Route::get('/login', [AdminController::class, 'getLogin'])->name('admin.login');
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::post('/login', [AdminController::class, 'postLogin'])->name('adminLoginPost');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/leads-list', [AdminController::class, 'getLeads']);
        Route::get('/dashboard', [AdminController::class, 'viewDashboard'])->name('admin.dashboard');
        Route::get('/filter-leads',[AdminController::class,'getFilterLeads'])->name('searchLeads');
        Route::get('/add-leads', [AdminController::class,'addLeads']);
        Route::get('/campaign-list', [AdminController::class, 'getCampaigns']);
        Route::post('store-campaign', [AdminController::class,'storeCampaign']);
        Route::post('/store-lead', [AdminController::class,'storeLead']);
        Route::get('/',[AdminController::class, 'template'] );
    });
});
