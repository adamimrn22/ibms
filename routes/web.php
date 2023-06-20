<?php

use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\RolesController;
use App\Http\Controllers\SuperAdmin\SAHomeController;
use App\Http\Controllers\SuperAdmin\PermissionController;
use App\Http\Controllers\SuperAdmin\PositionController;
use App\Http\Controllers\SuperAdmin\UnitController;
use App\Http\Controllers\SuperAdmin\UserController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/avatar/{userId}', [HomeController::class, 'showAvatar'])->name('avatar.show');
});

Route::get('/dashboard', function () {
    return view('Admin.dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'role:Super Admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/permission/lists', [PermissionController::class, 'showRoles']);
    Route::get('/dashboard', [SAHomeController::class, 'index']);
    Route::post('/userPermission/{id}', [PermissionController::class, 'storeUserPermission']);
    Route::post('/deleteUserPermission/{id}', [PermissionController::class, 'delteUserPermissionRoles']);

    Route::resource('/users', UserController::class);
    Route::resource('/roles', RolesController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/unit', UnitController::class);
    Route::resource('/position', PositionController::class);

});

Route::middleware(['auth', 'role:Admin UIT|Admin HR|Admin UKW|Super Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.dashboard');
    });
});


Route::middleware(['auth', 'role:User'])->group(function () {
    Route::get('/user', function () {
        dd(Auth::user()->isActive);
        // dd();

        // dd(Auth::user()->roles->pluck('name')[0]);
        // return view('admin.view');
    });
});


require __DIR__ . '/auth.php';
