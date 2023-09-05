<?php

namespace App\View\Components\ukw;

use Closure;
use App\Models\UkwInventory;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class inventoryStockLow extends Component
{
    protected $lowerStock;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->lowerStock = UkwInventory::where('current_quantity', '<=', 5)->select('name', 'current_quantity')->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $lowerStock = $this->lowerStock;
        return view('components.ukw.inventory-stock-low', compact('lowerStock'));
    }
}
