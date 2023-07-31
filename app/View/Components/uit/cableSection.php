<?php

namespace App\View\Components\uit;

use Closure;
use App\Models\SubCategory;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class cableSection extends Component
{
    private $cables;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->cables = SubCategory::where('category_id', 2)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $cables = $this->cables;
        return view('components.uit.cable-section', compact('cables'));
    }
}
