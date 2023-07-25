<?php

namespace App\View\Components\UKW;

use Closure;
use App\Models\SubCategory;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class alatTulisSection extends Component
{
    private $supplies;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->supplies = SubCategory::where('category_id', 6)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $supplies = $this->supplies;
        return view('components.ukw.alat-tulis-section', compact('supplies'));
    }
}
