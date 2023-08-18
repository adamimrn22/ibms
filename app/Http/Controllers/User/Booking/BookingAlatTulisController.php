<?php

namespace App\Http\Controllers\User\Booking;

use Carbon\Carbon;
use App\Models\UkwBooking;
use App\Mail\UserBookingUKW;
use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Mail\NewAlatTulisBooking;
use Spatie\Permission\Models\Role;
use App\Models\adminEmailReference;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Booking\UKWBookingController;

class BookingAlatTulisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);

        $user = Auth::user();
        $query = UkwBooking::query()->with('status');
        $data = $this->applyPaginationFilterSearch($query, $perPage, $user);

        return view('User.AlatTulis.alat-tulis-dashboard', compact('user', 'data'));
    }

    public function show(string $encryptReference)
    {
        $reference = Crypt::decryptString($encryptReference);

        $bookings = UkwBooking::with('inventories','user')
                ->withSum('inventories', 'ukw_bookings_inventories.quantity')
                ->where('reference', $reference)->get();
        $date =  Carbon::parse($bookings[0]->created_at)->format('F-j-Y H:i:s');

        $totalQuantity = $bookings[0]->inventories_sum_ukw_bookings_inventoriesquantity;

        return view('User.AlatTulis.pending-alat-tulis-details', compact('bookings', 'totalQuantity', 'date'));
    }

    /**
     * User Checkout
     */
    public function checkoutItem()
    {
        App::setLocale('ms');
        $carts = $this->getCartInfo();
        if(empty($carts['cart'])){
            abort(404);
        }
        $user = Auth::user();
        array_values($carts['cart']);

        return view('User.AlatTulis.checkout', compact('user', 'carts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function checkout(Request $request)
    {
        $submitBtn = $request->input('checkOutBtn');

        if($submitBtn){
            try {
                $items = session()->get('cart', []);
                $user = Auth::user();

                $items = array_map(function ($item) {
                    unset($item['name']);
                    unset($item['id']);
                    unset($item['subcategory']);
                    unset($item['image']);
                    return $item;
                }, $items);


                // Get the last booking reference and calculate the new reference
                $lastBooking = UkwBooking::latest()->where('reference', 'LIKE', 'UKWBK%')->first();
                $lastReferenceNumber = $lastBooking ? intval(substr($lastBooking->reference, 6)) : 0;
                $newReferenceNumber = $lastReferenceNumber + 1;
                $reference = 'UKWBK' . str_pad($newReferenceNumber, 4, '0', STR_PAD_LEFT);


                $booking = UkwBooking::create([
                    'reference' => $reference,
                    'user_id' => $user->id,
                    'status_id' => 1
                ]);

                $booking->inventories()->attach($items, [
                    'booking_id' => $booking->id
                ]);

                $role = Role::findByName('ADMIN UKW');
                $userWithRole = $role->users()->first();

                if ($userWithRole) {
                    $adminEmail = $userWithRole->email;
                    Mail::to($user->email)->queue(new UserBookingUKW($user, $booking->reference));
                    Mail::to($adminEmail)->queue(new NewAlatTulisBooking($user, $booking->reference));
                }

                // adminEmailReference::select('email')->where('unit_id', 3)->first();

                session()->forget('cart');
                session(['paper_decrement_amount' => 0]);

                return redirect()->route('AlatTulis.index')->with(['success' => 'Permohonan anda telah berjaya!']);
            } catch (\Throwable $th) {
                return redirect()->route('AlatTulis.index')->with(['error' => strval($th->getMessage())]);
            }
        }

        session()->forget('cart');
        session(['paper_decrement_amount' => 0]);
        return redirect()->route('AlatTulis.index')->with(['batal' => 'Permohonan anda telah Dibatalkan!']);
    }

    public function paperIndex(Request $request)
    {
        $cartInfo = $this->getCartInfo();

        // dd($cartInfo);
        return $this->handleAlatTulisIndex($request, 18, 'User.AlatTulis.table.paperTable', 'User.AlatTulis.alatTulisItem.paperBooking', $cartInfo);
    }

    public function fileIndex(Request $request)
    {
        $cartInfo = $this->getCartInfo();

        return $this->handleAlatTulisIndex($request, 19, 'User.AlatTulis.table.fileBookingTable', 'User.AlatTulis.alatTulisItem.fileBooking', $cartInfo);
    }

    public function stationeryIndex(Request $request)
    {
        $cartInfo = $this->getCartInfo();

        return $this->handleAlatTulisIndex($request, 20, 'User.AlatTulis.table.stationeryBookingTable', 'User.AlatTulis.alatTulisItem.stationeryBooking', $cartInfo);
    }

    public function a4Index(Request $request)
    {
        $cartInfo = $this->getCartInfo();

        return $this->handleAlatTulisIndex($request, 22, 'User.AlatTulis.table.a4BookingTable', 'User.AlatTulis.alatTulisItem.a4Booking', $cartInfo);
    }

    private function handleAlatTulisIndex(Request $request, $inventoryId, $tableView, $bookingView, $cartInfo)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UkwInventory::query();

        $data = $this->getAvailableAlatTulis($query, $inventoryId, $perPage, $searchTerm, $status);

        if ($request->ajax()) {
            return response()->json([
                'table' => view($tableView, compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        $cart = $cartInfo['cart'];
        $totalQuantity = $cartInfo['totalQuantity'];

        return view($bookingView, compact('data', 'cart', 'totalQuantity'));
    }


    public function applyPaginationFilterSearch($query, $perPage, $user)
    {
        $query->where('user_id', $user->id);

        $subQuery = UkwBooking::selectRaw('MAX(id) as id')
                    ->groupBy('reference')->where('status_id', 1);

        // Apply groupBy
        $query->whereIn('id', $subQuery);

        return $query->paginate($perPage);
    }

    public function getAvailableAlatTulis($query, $subcategory, $perPage, $searchTerm)
    {
        $query->where('subcategory_id', '=', $subcategory)->where('status_id', 9);
        // For search filtering
        if ($searchTerm) {
                $query->where('subcategory_id', '=', $subcategory)
                    ->where('status_id', 9)
                    ->where('name', 'LIKE', "%{$searchTerm}%");
        }
        // Apply pagination
        return $query->paginate($perPage);
    }

    private function getCartInfo()
    {
        $cart = session()->get('cart', []);
        $totalQuantity = 0;

        if ($cart) {
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }
        }

        return [
            'totalQuantity' => $totalQuantity,
            'cart' => $cart,
        ];
    }
}
