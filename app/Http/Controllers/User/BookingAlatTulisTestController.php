<?php

namespace App\Http\Controllers\User;

use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingAlatTulisTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $subcategory = $request->input('subcategory');

        $query = UkwInventory::query()->with('images');

        $cartInfo = $this->getCartInfo();

        $cart = $cartInfo['cart'];
        $totalQuantity = $cartInfo['totalQuantity'];

        $data = $this->getAvailableAlatTulis($query, $subcategory, $perPage, $searchTerm);

        if ($request->ajax()) {
            return response()->json([
                'grid' => view('User.AlatTulis.testAlatTulis.product-grid', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('User.AlatTulis.testAlatTulis.view-alat-tulis', compact('data', 'cart', 'totalQuantity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    private function getAvailableAlatTulis($query, $subcategory = '', $perPage, $searchTerm)
    {

        if($subcategory !== null && $subcategory !== 'All'){
            $query->where('subcategory_id', '=', $subcategory)->where('status_id', 9);
        }else {
            $query->where('status_id', 9);
        }

        if (!empty($searchTerm) && !empty($subcategory) && $subcategory !== 'All') {
            // Your search condition here
            $query->where('subcategory_id', '=', $subcategory)
                ->where('status_id', 9)
                ->where('name', 'LIKE', "%{$searchTerm}%");
        } else {
            // Default condition when no search or subcategory filter is applied
            $query->where('status_id', 9)
                ->where('name', 'LIKE', "%{$searchTerm}%");
        }

        return $query->paginate($perPage);
    }
}
