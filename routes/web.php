<?php

use App\Models\Booking;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\UnitController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\RolesController;
use App\Http\Controllers\SuperAdmin\SAHomeController;
use App\Http\Controllers\SuperAdmin\PositionController;
use App\Http\Controllers\SuperAdmin\PermissionController;
use App\Http\Controllers\Admin\Inventory\UIT\CableController;
use App\Http\Controllers\Admin\Inventory\UPSM\ClassroomController;
use App\Http\Controllers\Admin\Inventory\UPSM\OfficeRoomController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\LaptopController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\DesktopController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\KeyboardController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\MonitorController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\MouseController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\ProjectorController;

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
    Route::resource('/users', UserController::class);
    Route::resource('/unit', UnitController::class);
    Route::resource('/position', PositionController::class);

});

Route::get('/dashboard', function () {
    return view('Admin.dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'role:Super Admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/permission/lists', [PermissionController::class, 'showRoles']);
    Route::get('/dashboard', [SAHomeController::class, 'index']);
    Route::post('/userPermission/{id}', [PermissionController::class, 'storeUserPermission']);
    Route::post('/deleteUserPermission/{id}', [PermissionController::class, 'delteUserPermissionRoles']);

    Route::resource('/roles', RolesController::class);
    Route::resource('/permission', PermissionController::class);
});


Route::middleware(['auth', 'role:Admin UIT|Admin UPSM|Admin UKW|Super Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.dashboard');
    });

});


Route::middleware(['auth', 'role:Admin UIT|Super Admin'])->prefix('Inventory/UIT')->name('uit.')->group(function () {
    Route::prefix('/Hardware')->group(function() {
        Route::resource('/Desktop', DesktopController::class);
        Route::resource('/Laptop', LaptopController::class);
        Route::resource('/Monitor', MonitorController::class);
        Route::resource('/Mouse', MouseController::class);
        Route::resource('/Keyboard', KeyboardController::class);
        Route::resource('/Projector', ProjectorController::class);
    });
    Route::resource('/Cable', CableController::class);
    Route::resource('/Others', CableController::class);
});

Route::middleware(['auth', 'role:Admin UPSM|Super Admin'])->prefix('Inventory/UPSM')->name('upsm.')->group(function () {
    Route::resource('/Classroom', ClassroomController::class);
    Route::resource('/Office', OfficeRoomController::class);
});


Route::middleware(['auth', 'role:User'])->group(function () {
    Route::get('/user', function () {
        dd(Auth::user()->isActive);
    });
});


Route::get('/test', function(){
    $booking = Booking::with('inventory', 'staff')->where('inventory_id', 10)->get();
    $desktop = Inventory::with('bookings', 'staff')->findOrFail(10);
    $desktop->attribute = json_decode($desktop->attribute);
    // dd($booking);
    return view('test', compact('booking', 'desktop'));
});

Route::post('/test', function(){
    $staffId = 2; // Staff ID

    $locationId = 10; // The desired location ID

    $booking = new Booking();
    $booking->start_date = '2023-07-15'; // Example start date
    $booking->end_date = '2023-07-20'; // Example end date
    $booking->end_date = '2023-07-20'; // Example end date

    $booking->user_id = $staffId;
    $booking->inventory_id = $locationId;
    // Save the booking
    $booking->save();

    // Set the location on the related inventory model
    $booking->inventory->location = $staffId;
    $booking->inventory->save();
});

require __DIR__ . '/auth.php';
