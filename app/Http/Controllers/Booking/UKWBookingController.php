<?php

namespace App\Http\Controllers\Booking;

use App\Models\UkwBooking;
use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendUserBookingJob;
use App\Mail\UserBookingUKW;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\UserPaperBookingAmount;
use App\Notifications\UserBookingUkwSend;
use Illuminate\Notifications\Notification;

class UKWBookingController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UkwInventory::query();

        $data = $this->getAvailableAlatTulis($query, 18, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('User.UkwBooking.table.paperBookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        $cart = $request->session()->get('cart', []);
        $totalQuantity = 0;

        if($cart){
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }
        }

        return view('User.UkwBooking.bookingItem.paperBooking', compact('data', 'cart', 'totalQuantity'));
    }

    public function fileIndex(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UkwInventory::query();

        $data = $this->getAvailableAlatTulis($query, 19, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('User.UkwBooking.table.fileBookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        $cart = $request->session()->get('cart', []);
        $totalQuantity = 0;

        if($cart){
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }
        }

        return view('User.UkwBooking.bookingItem.fileBooking', compact('data', 'cart', 'totalQuantity'));
    }

    public function stationeryIndex(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UkwInventory::query();

        $data = $this->getAvailableAlatTulis($query, 20, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('User.UkwBooking.table.stationeryBookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        $cart = $request->session()->get('cart', []);
        $totalQuantity = 0;

        if($cart){
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }
        }

        return view('User.UkwBooking.bookingItem.stationeryBooking', compact('data', 'cart', 'totalQuantity'));
    }

    public function a4Index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UkwInventory::query();

        $data = $this->getAvailableAlatTulis($query, 22, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUKW.table.a4paperTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        $cart = $request->session()->get('cart', []);
        $totalQuantity = 0;

        if($cart){
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }
        }

        return view('User.UkwBooking.bookingItem.a4Booking', compact('data', 'cart', 'totalQuantity'));
    }

    /*
        Checkout view and checkout booking
    */
     public function checkoutItem()
    {
        $carts = session()->get('cart', []);
        $totalQuantity = 0;

        if(empty($carts)){
            abort(404, 'Not Found');
        }

        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'];
        }

        return view('User.UkwBooking.checkout', compact('carts', 'totalQuantity'));
    }


    public function checkout()
    {
        $items = array_values(session()->get('cart', []));
        $user = Auth::user();

        // Get the last booking reference and calculate the new reference
        $lastBooking = UkwBooking::latest()->where('reference', 'LIKE', 'UKWBK%')->first();
        $lastReferenceNumber = $lastBooking ? intval(substr($lastBooking->reference, 6)) : 0;
        $newReferenceNumber = $lastReferenceNumber + 1;
        $reference = 'UKWBK' . str_pad($newReferenceNumber, 4, '0', STR_PAD_LEFT);

        foreach ($items as $item) {
            UkwBooking::create([
                'reference' => $reference,
                'quantity' => $item['quantity'],
                'approved_quantity' => $item['quantity'],
                'user_id' => $user->id,
                'inventory_id' => $item['id'],
                'status_id' => 1
            ]);
        }

        $bookings = UkwBooking::where('reference', $reference)->get();

        session()->forget('cart');
        session(['paper_decrement_amount' => 0]);

        Mail::to($user->email)->queue(new UserBookingUKW($user, $bookings));

        return redirect()->route('user.homepage')->with(['success' => 'Permohonan anda telah berjaya!']);
    }

    // Cart
    public function addToCart(Request $request)
    {
        $itemId = $request->input('item_id');

        $product = UkwInventory::with('images')->findOrFail($itemId);
        $cart = session()->get('cart', []);


        if (!empty($product)) {


            if ($product->subcategory_id == 22) {
                $result = $this->checkUserPaperLimit();

                if ($result['error']) {
                    return response()->json(['error' => $result['message']]);
                }

                // Increment the paper_decrement_amount session key
                session(['paper_decrement_amount' => session('paper_decrement_amount', 0) + 1]);

            }

            if(isset($cart[$itemId])) {

                if ($cart[$itemId]['quantity'] >= $product->current_quantity) {
                    return response()->json(['error' => 'Kuantiti telah mencapai had']);
                }

                $cart[$itemId]['quantity']++;

            } else {
                $cart[$itemId] = [
                    "id" => $itemId,
                    "name" => $product->name,
                    "quantity" => 1,
                    "image" =>  $product->images->parent_folder . '/' . $product->images->path
                ];
            }

            session()->put('cart', $cart);

            return response()->json([
                'cart' => view('User.UkwBooking.cart')->render(),
                'message' => 'Item added to cart'
            ]);
        }

        return response()->json(['message' => 'Item not found in cart']);
    }

    public function getCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $totalQuantity = 0;

        if($cart){
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }
        }

        return response()->json([
            'totalQuantity' => $totalQuantity,
            'cart' => view('User.UkwBooking.cart', compact('cart'))->render()
        ]);
    }

    public function decrementQuantity(Request $request, $itemId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            $product = UkwInventory::findOrFail($itemId);

            // If the product is in the "a4" category, decrement the paper_decrement_amount
            if ($product->subcategory_id === 22) {
                $decrementAmount = session('paper_decrement_amount', 0);
                if ($decrementAmount > 0) {
                    session(['paper_decrement_amount' => $decrementAmount - 1]);
                }
            }

            $cart[$itemId]['quantity']--;

            if ($cart[$itemId]['quantity'] <= 0) {
                unset($cart[$itemId]);
            }
        }


        session()->put('cart', $cart);

        return response()->json(['message' => 'Item quantity decremented' ]);
    }

    public function incrementQuantity(Request $request, $itemId)
    {
        $cart = session()->get('cart', []);
        $quantity = UkwInventory::select('current_quantity')->where('id', $itemId)->first();

        if (isset($cart[$itemId])) {
            // Check if the cart quantity is already equal to or greater than the current quantity
            if ($cart[$itemId]['quantity'] >= $quantity->current_quantity) {
                // If so, do not increment and return
                return response()->json(['error' => 'Kuantiti telah mencapai had']);
            }

            // Check if the product is in the "a4" category
            $product = UkwInventory::find($itemId);
            if ($product->subcategory_id === 22) {
                $result = $this->checkUserPaperLimit();
                if ($result['error']) {
                    return response()->json(['error' => $result['message']]);
                }

                // Increment the paper_decrement_amount session key
                session(['paper_decrement_amount' => session('paper_decrement_amount', 0) + 1]);
            }

            // Increment the quantity
            $cart[$itemId]['quantity']++;

            session()->put('cart', $cart);

            return response()->json(['message' => 'Item quantity incremented']);
        }

        return response()->json(['message' => 'Item not found in cart']);
    }

    public function removeItem($itemId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            $product = UkwInventory::findOrFail($itemId);

            // If the product is in the "a4" category, decrement the paper_decrement_amount
            if ($product->subcategory_id === 22) {
                session(['paper_decrement_amount' => 0]);
            }

            // Remove the item from the cart
            unset($cart[$itemId]);
            session()->put('cart', $cart);

            return response()->json(['message' => 'Item removed from cart']);
        }

        return response()->json(['message' => 'Item not found in cart']);
    }

    public function clearCart()
    {
        session()->forget('cart');

        session(['paper_decrement_amount' => 0]);

        return response()->json(['message' => 'Cart cleared']);
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

    private function checkUserPaperLimit()
    {
        $userPaperLimit = UserPaperBookingAmount::where('user_id', Auth::user()->id)->first();

        $decrementAmount = session('paper_decrement_amount', 0);

        if ($userPaperLimit->amount - $decrementAmount <= 0) {
            return ['error' => true, 'message' => 'Amount pinjaman Kertas telah mencapai had untuk bulan ini'];
        }

        return ['error' => false, 'message' => ''];
    }

}
