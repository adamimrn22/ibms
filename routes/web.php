<?php

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Inventory;
use App\Models\UkwBooking;
use App\Models\BookingStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\UserPaperBookingAmount;
use App\Http\Controllers\TempfileController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\SuperAdmin\UnitController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\Admin\Booking\UKW\A4Amount;
use App\Http\Controllers\SuperAdmin\RolesController;
use App\Http\Controllers\SuperAdmin\SAHomeController;
use App\Http\Controllers\User\Booking\CartController;
use App\Http\Controllers\Booking\UKWBookingController;
use App\Http\Controllers\SuperAdmin\PositionController;
use App\Http\Controllers\UserBookingDashboardController;
use App\Http\Controllers\SuperAdmin\PermissionController;
use App\Http\Controllers\Booking\UpsmCarBookingController;
use App\Http\Controllers\Admin\Inventory\UKW\FileController;
use App\Http\Controllers\Admin\Inventory\UPSM\CarController;
use App\Http\Controllers\Admin\Inventory\UIT\CableController;
use App\Http\Controllers\Admin\Inventory\UKW\PaperController;
use App\Http\Controllers\Admin\Booking\UKW\A4AmountController;
use App\Http\Controllers\Admin\Inventory\UKW\A4PaperController;
use App\Http\Controllers\Admin\Inventory\UKW\SuppliesController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\DviController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\UsbController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\VgaController;
use App\Http\Controllers\User\Booking\BookingAlatTulisController;
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
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\DesktopController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\MonitorController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\PrinterController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\KeyboardController;
use App\Http\Controllers\Admin\Inventory\UIT\Hardware\ProjectorController;
use App\Http\Controllers\Admin\Inventory\UIT\Cable\CableController as CableCableController;

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
        Route::resource('/Others', CableCableController::class);
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
    });
});

Route::middleware(['auth', 'role:Admin UKW|Super Admin'])->prefix('UKW')->name('ukw.')->group(function () {

    Route::prefix('/Inventory')->group(function() {
        Route::resource('/File', FileController::class);
        Route::resource('/Paper', PaperController::class);
        Route::resource('/Stationery', StationeryController::class);

        Route::get('AlatTulis', [UKWBookingController::class, 'index'])->name('AlatTulis.index');
        Route::get('/A4 Paper', [A4PaperController::class, 'index'])->name('A4 Paper.index');
        Route::delete('/A4_Paper/{Paper}', [A4PaperController::class, 'destroy']);

        Route::resource('/Supply', SuppliesController::class);

        Route::post('/tmp-upload', [TempfileController::class, 'tmpSupplyUpload'])->name('supply-tmp-upload');
        Route::delete('/tmp-delete', [TempfileController::class, 'tmpSupplyDelete'])->name('supply-tmp-delete');
    });

    Route::prefix('Booking/UKW')->group(function() {
        Route::resource('/BookingAlatTulis', AlatTulisBookingController::class);
        Route::resource('/Amount', A4AmountController::class);
    });



});


Route::middleware(['auth', 'role:User'])->prefix('/User')->group(function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('user.homepage');
    Route::prefix('/Booking/UKW')->group(function() {

        Route::get('AlatTulis', [BookingAlatTulisController::class, 'index'])->name('AlatTulis.index');
        Route::get('AlatTulis/Booking/{Booking}', [BookingAlatTulisController::class, 'show'])->name('AlatTulis.show');
        Route::get('AlatTulis/Paper', [BookingAlatTulisController::class, 'paperIndex'])->name('AlatTulis.paper');
        Route::get('AlatTulis/File', [BookingAlatTulisController::class, 'fileIndex'])->name('AlatTulis.file');
        Route::get('AlatTulis/Stationery', [BookingAlatTulisController::class, 'stationeryIndex'])->name('AlatTulis.stationery');
        Route::get('AlatTulis/A4', [BookingAlatTulisController::class, 'a4Index'])->name('AlatTulis.a4');
        Route::get('AlatTulis/checkout', [BookingAlatTulisController::class, 'checkoutItem'])->name('AlatTulis.checkoutItem');
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
    });

});


Route::get('/test', function(){

    // $user = Auth::user();

    // $booking = UkwBooking::with('inventories' )
    // ->withSum('inventories', 'ukw_bookings_inventories.quantity')
    // ->where('reference', 'UKWBK0001')->first();

    // $totalQuantity =  $totalQuantity = $booking->inventories_sum_ukw_bookings_inventoriesquantity;

    // $orderID = $booking->reference;

    // $totalQuantity = $booking->inventories_sum_ukw_bookings_inventoriesquantity;


    // $formatBookDate = Carbon::parse($booking->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
    // $formatApprovedDate = Carbon::parse($booking->updated_at)->formatLocalized('%B %d, %Y %I:%M %p');

    // $bookDate =  $formatBookDate;
    // $approvedDate =  $formatApprovedDate;

    // return view('mail.bookingAlatTulis.approvedBooking', compact(
    //     'user' ,
    //     'booking' ,
    //     'orderID' ,
    //     'totalQuantity',
    //     'bookDate',
    //     'approvedDate',
    // ));
});

// Route::get('/test1', [UserBookingDashboardController::class, 'index']);
// Route::get('/testAlatanTulis', [UserBookingDashboardController::class, 'testShow']);
// Route::get('/checkoutTest', [UserBookingDashboardController::class, 'checkOut']);

// Route::get('/test', function(){
//     $user = Auth::user();
//     return view('test.test1', compact('user'));
// });



// Route::get('/mail', function() {
//     $user = Auth::user();
//     $bookings = UkwBooking::with('inventory')->where('reference', 'UKWBK0001')->get();
//     $orderID = $bookings[0]->reference;
//     // dd($bookings[0]);
//     $totalQuantity = $bookings->sum('quantity');
//     $date = Carbon::parse($bookings[0]->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
//     return view('mail.ukwuserbooking', compact('user', 'bookings', 'date', 'orderID', 'totalQuantity'));
// });

require __DIR__ . '/auth.php';
