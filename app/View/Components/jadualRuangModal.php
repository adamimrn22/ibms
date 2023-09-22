<?php

namespace App\View\Components;

use Closure;
use App\Models\UpsmInventory;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class jadualRuangModal extends Component
{
    protected $rooms;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->rooms = UpsmInventory::where('subcategory_id', '=', 16)->where('status_id', '=', 6)->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $rooms = $this->rooms;
        return view('components.jadual-ruang-modal', compact('rooms'));
    }
}
