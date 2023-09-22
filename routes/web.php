<?php

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\UpsmInventory;
use App\Models\UpsmRuangBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TempfileController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\SuperAdmin\UnitController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\RolesController;
use App\Http\Controllers\SuperAdmin\SAHomeController;
use App\Http\Controllers\User\Booking\CartController;
use App\Http\Controllers\SuperAdmin\PositionController;
use App\Http\Controllers\SuperAdmin\PermissionController;
use App\Http\Controllers\Admin\Inventory\UKW\FileController;
use App\Http\Controllers\Admin\Inventory\UPSM\CarController;
use App\Http\Controllers\Admin\Inventory\UKW\PaperController;
use App\Http\Controllers\User\BookingAlatTulisTestController;
use App\Http\Controllers\Admin\Booking\UKW\A4AmountController;
use App\Http\Controllers\Admin\Inventory\UIT\OthersController;
use App\Http\Controllers\User\Booking\UitPeripheralController;
use App\Http\Controllers\Admin\Inventory\UKW\A4PaperController;
use App\Http\Controllers\Admin\Inventory\UKW\SuppliesController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\DviController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\UsbController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\VgaController;
use App\Http\Controllers\User\Booking\BookingAlatTulisController;
use App\Http\Controllers\User\Reservation\RuangBookingController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\HdmiController;
use App\Http\Controllers\Admin\Inventory\UKW\StationeryController;
use App\Http\Controllers\Admin\Inventory\UPSM\ClassroomController;
use App\Http\Controllers\Admin\Inventory\UPSM\OfficeRoomController;
use App\Http\Controllers\User\Reservation\CarReservationController;
use App\Http\Controllers\Admin\Booking\UKW\AlatTulisBookingController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\EthernetController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\PsuCableController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\MouseController;
use App\Http\Controllers\Admin\Booking\UPSM\KenderaanBookingController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\LaptopController;
use App\Http\Controllers\Admin\Inventory\UIT\Others\SoftwareController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\DesktopController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\MonitorController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\PrinterController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\KeyboardController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\ExtensionController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\ProjectorController;
use App\Http\Controllers\Admin\Inventory\UIT\Others\MiscellaneousController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\CableController as CableCableController;
use App\Http\Controllers\Admin\Booking\UPSM\RuangBookingController as UPSMRuangBookingController;

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


Route::middleware(['auth'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/unit', UnitController::class);
    Route::resource('/position', PositionController::class);

    Route::get('/', function () {

        $user = Auth::user();

        if ($user->roles->pluck('name')[0] === 'Super Admin') {
            return redirect()->intended('/superadmin/dashboard');
        } else if (str_contains($user->roles->pluck('name')[0], 'Admin')) {
            return redirect()->intended('/admin/dashboard');
        } else if ($user->roles->pluck('name')[0] === 'User') {
            return redirect()->intended('/User');
        } else {
            abort(response('Unauthorized', 401));
        }
    });


    Route::get('/jadualRuang', [RuangBookingController::class, 'ruangTempah']);
    // Route::get('/jadualRuang', function(Request $request){

    //     $roomRaw = $request->input('room_type');
    //     $roomInput = explode("|", $roomRaw);
    //     $roomSelectedID = $roomInput[0];
    //     $roomName = $roomInput[1];

    //     $bookData = UpsmRuangBooking::with('detail', 'room')->where('room_id', $roomSelectedID)->get();
    //     $rooms = UpsmInventory::where('subcategory_id', '=', 16)->where('status_id', '=', 6)->get();

    //     return view('testbiew', compact('bookData', 'rooms', 'roomName', 'roomSelectedID'));
    // });


});

Route::get('/dashboard', function () {
    return view('Admin.dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'role:Super Admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/permission/lists', [PermissionController::class, 'showRoles']);
    Route::get('/dashboard', [SAHomeController::class, 'index'])->name('dashboard');
    Route::post('/userPermission/{id}', [PermissionController::class, 'storeUserPermission']);
    Route::post('/deleteUserPermission/{id}', [PermissionController::class, 'delteUserPermissionRoles']);

    Route::resource('/roles', RolesController::class);
    Route::resource('/permission', PermissionController::class);
});


Route::middleware(['auth', 'role:Admin UIT|Admin UPSM|Admin UKW|Super Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth', 'role:Admin UIT|Super Admin'])->prefix('UIT')->name('uit.')->group(function () {
    Route::prefix('/Inventory')->group(function() {
        Route::prefix('/Hardware')->group(function () {
            Route::resource('/Desktop', DesktopController::class);
            Route::resource('/Laptop', LaptopController::class);
            Route::resource('/Monitor', MonitorController::class);
            Route::resource('/Mouse', MouseController::class);
            Route::resource('/Keyboard', KeyboardController::class);
            Route::resource('/Printer', PrinterController::class);
            Route::resource('/Projector', ProjectorController::class);
            Route::resource('/Extension-cord', ExtensionController::class);
        });
        Route::prefix('/Cable')->group(function () {
            Route::resource('/Cable', CableCableController::class);
            Route::resource('/Hdmi', HdmiController::class);
            Route::resource('/Vga', VgaController::class);
            Route::resource('/Ethernet', EthernetController::class);
            Route::resource('/Dvi', DviController::class);
            Route::resource('/Usb', UsbController::class);
            Route::resource('/Psu', PsuCableController::class);
        });
        Route::prefix('/Others')->group(function () {
            Route::resource('/Software', SoftwareController::class);
            Route::resource('/Miscellaneous', MiscellaneousController::class);
        });
    });

});

Route::middleware(['auth', 'role:Admin UPSM|Super Admin'])->prefix('UPSM')->name('upsm.')->group(function () {
    Route::prefix('/Inventory')->group(function() {
        Route::resource('/Classroom', ClassroomController::class);
        Route::resource('/Office', OfficeRoomController::class);
        Route::resource('/Kenderaan', CarController::class);

        Route::post('/tmp-upload', [ClassroomController::class, 'tmpUpload'])->name('classroom-tmp-upload');
        Route::delete('/tmp-delete', [ClassroomController::class, 'tmpDelete'])->name('classroom-tmp-delete');
    });
    Route::prefix('/Booking')->group(function() {
        Route::prefix('/Kenderaan')->group(function() {
            Route::get('/', [KenderaanBookingController::class, 'index'])->name('BookingKenderaan.index');
            Route::get('/History', [KenderaanBookingController::class, 'indexHistory'])->name('BookingKenderaan.indexHistory');
            Route::get('/{Kenderaan}/edit', [KenderaanBookingController::class, 'edit'])->name('BookingKenderaan.edit');
            Route::put('/{Kenderaan}/edit', [KenderaanBookingController::class, 'update'])->name('BookingKenderaan.update');
            Route::get('/PDF/{Kenderaan}', [KenderaanBookingController::class, 'generatePDF'])->name('BookingKenderaan.generatePDF');
        });

        Route::prefix('/Ruang')->group(function() {
            Route::get('/', [UPSMRuangBookingController::class, 'index'])->name('ruangTempah.index');
            Route::get('/TempahHistory', [UPSMRuangBookingController::class, 'indexHistory'])->name('ruangTempah.indexHistory');
            Route::get('/{Ruang}', [UPSMRuangBookingController::class, 'edit'])->name('ruangTempah.edit');
            Route::get('/Tempahan/RuangTempah', [RuangBookingController::class, 'ruangTempah'])->name('ruangTempah.view');
            Route::put('/Update/{Ruang}', [UPSMRuangBookingController::class, 'update'])->name('ruangTempah.update');
        });
    });
});

Route::middleware(['auth', 'role:Admin UKW|Super Admin'])->prefix('UKW')->name('ukw.')->group(function () {

    Route::prefix('/Inventory')->group(function() {
        Route::get('/GetAlatTulisQuantityStock/{id}', [SuppliesController::class, 'getQuantity'])->name('getAlatTulisStock');
        Route::post('/AlatTulisQuantityStock/{id}', [SuppliesController::class, 'updateQuantity'])->name('updateAlatTulisStock');

        Route::resource('/File', FileController::class);
        Route::resource('/Paper', PaperController::class);
        Route::resource('/Stationery', StationeryController::class);

        // Route::get('AlatTulis', [UKWBookingController::class, 'index'])->name('AlatTulis.index');
        Route::get('/A4 Paper', [A4PaperController::class, 'index'])->name('A4 Paper.index');
        Route::delete('/A4_Paper/{Paper}', [A4PaperController::class, 'destroy']);

        Route::resource('/Supply', SuppliesController::class);

        Route::post('/tmp-upload', [TempfileController::class, 'tmpSupplyUpload'])->name('supply-tmp-upload');
        Route::delete('/tmp-delete', [TempfileController::class, 'tmpSupplyDelete'])->name('supply-tmp-delete');
    });

    Route::prefix('Booking')->group(function() {
        Route::prefix('/AlatTulis')->group(function() {
            Route::get('/History', [AlatTulisBookingController::class, 'indexHistory'])->name('BookingAlatTulis.indexHistory');
            Route::get('/PDF/{BookingAlatTulis}', [AlatTulisBookingController::class, 'generatePDF'])->name('BookingAlatTulis.generatePDF');
            Route::resource('/BookingAlatTulis', AlatTulisBookingController::class);
            Route::get('/AlatTulis/Images', [BookingAlatTulisController::class, 'viewAlatTulisImage'])->name('BookingAlatTulis.image');


            Route::put('/Amount/ResetStaff', [A4AmountController::class, 'update'])->name('Amount.update');
            Route::post('/Amount', [A4AmountController::class, 'store'])->name('Amount.store');
            Route::get('/Amount', [A4AmountController::class, 'index'])->name('Amount.index');

            // Route::resource('/Amount', A4AmountController::class);
        });
    });

    Route::get('/ExportAmount', [ExportController::class, 'exportUserA4Amount'])->name('export.a4Amount');
    Route::get('/ExportStockAlatTulis', [ExportController::class, 'exportAlatTulisAmount'])->name('export.stockAlatTulis');
});


Route::middleware(['auth', 'role:User'])->prefix('/User')->group(function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('user.homepage');
    Route::prefix('/Booking/UKW')->group(function() {
        Route::get('AlatTulis', [BookingAlatTulisController::class, 'index'])->name('AlatTulis.index');
        Route::get('ViewAlatTulis', [BookingAlatTulisController::class, 'itemIndex'])->name('AlatTulis.itemIndex');
        Route::get('AlatTulis/Booking/{Booking}', [BookingAlatTulisController::class, 'show'])->name('AlatTulis.show');
        Route::get('AlatTulis/checkout', [BookingAlatTulisController::class, 'checkoutItem'])->name('AlatTulis.checkoutItem');
        Route::get('AlatTulis/Images', [BookingAlatTulisController::class, 'viewAlatTulisImage'])->name('AlatTulis.image');
        Route::post('AlatTulis/checkout', [BookingAlatTulisController::class, 'checkout'])->name('AlatTulis.checkout');

        Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('/get-cart', [CartController::class,'getCart'])->name('cart.get');
        Route::post('/cart/decrement/{itemId}',  [CartController::class,'decrementQuantity'] )->name('cart.decrement');
        Route::post('/cart/increment/{itemId}',  [CartController::class,'incrementQuantity'] )->name('cart.increment');
        Route::delete('/cart/remove/{itemId}', [CartController::class,'removeItem'])->name('cart.remove');
        Route::delete('/cart/clear', [CartController::class,'clearCart'])->name('cart.clear');

    });

    Route::prefix('/Booking/UPSM')->group(function() {
        Route::prefix('/TempahanKereta')->group(function() {
            Route::get('/Tempah', [CarReservationController::class, 'index'])->name('TempahKereta.index');
            Route::post('/Tempah', [CarReservationController::class, 'store'])->name('TempahKereta.store');
        });

        Route::prefix('/Ruang')->group(function() {
            Route::get('/Tempah', [RuangBookingController::class, 'index'])->name('TempahRuang.index');
             Route::get('/ViewTempahan', [RuangBookingController::class, 'viewTempahan'])->name('TempahRuang.viewTempahan');
            Route::get('/Tempah/{Ruang}', [RuangBookingController::class, 'create'])->name('TempahRuang.booking');
            Route::post('/Tempah/{Ruang}', [RuangBookingController::class, 'store'])->name('TempahRuang.store');
            Route::get('/Tempahan/RuangTempah', [RuangBookingController::class, 'ruangTempah'])->name('TempahRuang.view');
            Route::get('/disabledTimeRange', [RuangBookingController::class, 'getDisabledTimeRanges'])->name('TempahRuang.disabled.time.ranges');
        });
    });

    Route::prefix('/Booking/UIT')->group(function() {
        Route::resource('PinjamanUit', UitPeripheralController::class);
    });

});


require __DIR__ . '/auth.php';
