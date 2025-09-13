<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleRightController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/admin-login', [AuthController::class, 'login'])->name('login');
Route::post('/admin-login', [AuthController::class, 'adminlogin'])->name('admin.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Role Right start
    |--------------------------------------------------------------------------
    */

    Route::get('/get-role', [RoleRightController::class, 'indexRole'])->name('index.role');
    Route::get('/insert-role', [RoleRightController::class, 'createRole'])->name('create.role');
    Route::post('/insert-role', [RoleRightController::class, 'storeRole'])->name('store.role');
    Route::get('/update-role/{id}', [RoleRightController::class, 'editRole'])->name('edit.role');
    Route::put('/update-role/{id}', [RoleRightController::class, 'updateRole'])->name('update.role');
    Route::delete('/delete-role/{id}', [RoleRightController::class, 'deleteRole'])->name('delete.role');

    Route::get('/get-right', [RoleRightController::class, 'indexRight'])->name('index.right');
    Route::get('/insert-right', [RoleRightController::class, 'createRight'])->name('create.right');
    Route::post('/insert-right', [RoleRightController::class, 'storeRight'])->name('store.right');
    Route::get('/update-right/{id}', [RoleRightController::class, 'editRight'])->name('edit.right');
    Route::put('/update-right/{id}', [RoleRightController::class, 'updateRight'])->name('update.right');
    Route::delete('/delete-right/{id}', [RoleRightController::class, 'deleteRight'])->name('delete.right');

    Route::get('/get-role-for-right', [RoleRightController::class, 'getRoleForRight'])->name('get.role.for.right');
    Route::get('/get-right-for-role/{id}', [RoleRightController::class, 'getRightForRole'])->name('get.right.for.role');
    Route::post('/update-role-right/{id}', [RoleRightController::class, 'updateRoleRights'])->name('update.role.right');

    /*
    |--------------------------------------------------------------------------
    | User start
    |--------------------------------------------------------------------------
    */

    Route::get('index-user', [UserController::class, 'indexUser'])->name('index.user');
    Route::get('insert-user', [UserController::class, 'createUser'])->name('create.user');
    Route::post('insert-user', [UserController::class, 'storeUser'])->name('store.user');
    Route::get('update-user/{id}', [UserController::class, 'editUser'])->name('edit.user');
    Route::put('update-user/{id}', [UserController::class, 'updateUser'])->name('update.user');

    Route::get('profle-update', [PasswordController::class, 'profileupdate'])->name('profle.update');
    Route::post('profle-update', [PasswordController::class, 'passwordupdate'])->name('password.update');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    
});
