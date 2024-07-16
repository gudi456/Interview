<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('register',[RegisterController::class,'index'])->name('register');
Route::post('register',[RegisterController::class,'register'])->name('register.user');
Route::get('cities/{state_id}', [RegisterController::class, 'getCitiesByState'])->name('cities.state');

//login route call
Route::get('login',[RegisterController::class,'login'])->name('user.login');
Route::post('post-login',[RegisterController::class,'postLogin'])->name('login.user');

Route::middleware('redirectToDashboard')->group(function () {
    
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
    Route::get('/users/data', [DashboardController::class, 'data'])->name('users.data');

    // Roles
    Route::get('/roles', [RoleController::class,'index'])->name('roles.index');
    Route::get('/roles/data', [RoleController::class, 'data'])->name('roles.data');
    Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class,'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class,'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class,'update'])->name('roles.update');
    Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/permissions', [PermissionController::class,'index'])->name('permissions.index');
    Route::get('/permissions/data', [PermissionController::class, 'data'])->name('permissions.data');
    Route::get('/permissions/create',[PermissionController::class,'create'])->name('permissions.create');
    Route::post('/permissions/store', [PermissionController::class,'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class,'edit'])->name('permissions.edit');
    Route::put('/permissions/{id}', [PermissionController::class,'update'])->name('permissions.update');
    Route::get('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('index',[RolePermissionController::class,'index'])->name('role-permission.index');
    Route::post('/roles-permissions', [RolePermissionController::class, 'store'])->name('role-permission.store');

    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('suppliers/data', [SupplierController::class, 'data'])->name('suppliers.data');
    Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('suppliers/store', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::get('suppliers/delete/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/data', [CustomerController::class, 'data'])->name('customers.data');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
});
