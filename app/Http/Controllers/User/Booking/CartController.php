<?php

namespace App\Http\Controllers\User\Booking;

use Carbon\Carbon;
use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPaperBookingAmount;

class CartController extends Controller
{
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
            }

            if(isset($cart[$itemId])) {

                if ($cart[$itemId]['quantity'] >= $product->current_quantity) {
                    return response()->json(['error' => 'Alatan Tulis telah kehabisan stok']);
                }

                if($cart[$itemId]['subcategory'] == 22){
                    // Increment the paper_decrement_amount session key
                    session(['paper_decrement_amount' => session('paper_decrement_amount', 0) + 1]);
                }

                $cart[$itemId]['quantity']++;

            } else {

                $item = $cart[$itemId] = [
                    "id" => $itemId,
                    "name" => $product->name,
                    "quantity" => 1,
                    "subcategory" => $product->subcategory_id,
                    "image" =>  $product->images->parent_folder . '/' . $product->images->path
                ];

                if($item['subcategory'] == 22){
                    session(['paper_decrement_amount' => session('paper_decrement_amount', 0) + 1]);
                }

            }

            session()->put('cart', $cart);

            return response()->json([
                'cart' => view('User.AlatTulis.cart')->render(),
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
            'cart' => view('User.AlatTulis.cart', compact('cart'))->render()
        ]);
    }

    public function decrementQuantity(Request $request, $itemId)
    {
        $cart = $request->session()->get('cart', []);

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

    public function incrementQuantity($itemId)
    {
        $cart = session()->get('cart', []);
        $quantity = UkwInventory::select('current_quantity')->where('id', $itemId)->first();

        if (isset($cart[$itemId])) {
            // Check if the cart quantity is already equal to or greater than the current quantity
            if ($cart[$itemId]['quantity'] >= $quantity->current_quantity) {
                // If so, do not increment and return
                return response()->json(['error' => 'Alatan Tulis telah kehabisan stok']);
            }

            // Check if the product is in the "a4" category
            $product = UkwInventory::find($itemId);
            if ($product->subcategory_id === 22) {
                $result = $this->checkUserPaperLimit();
                if ($result['error']) {
                    return response()->json(['error' => $result['message']]);
                }
                session(['paper_decrement_amount' => session('paper_decrement_amount', 0) + 1]);
            }
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
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentMonth = $now->month;


        $userPaperLimit = UserPaperBookingAmount::where('year', $currentYear)
            ->where('month', $currentMonth)
            ->where('user_id', Auth::user()->id)->first();

        if($userPaperLimit){
            $decrementAmount = session('paper_decrement_amount', 0);

            if ($userPaperLimit->amount - $decrementAmount <= 0) {
                return ['error' => true, 'message' => 'Amount pinjaman Kertas telah mencapai had untuk bulan ini'];
            }
            return ['error' => false, 'message' => ''];
        }

        return ['error' => true, 'message' => 'Amount bagi a4 anda bulan ini tidak di set'];
    }
}
