<?php

namespace App\View\Components\uit;

use App\Models\SubCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class hardwareSection extends Component
{
    private $hardware;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->hardware = SubCategory::where('category_id', 1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $hardwares = $this->hardware;
        return view('components.uit.hardware-section', compact('hardwares'));
    }
}
