<?php

namespace App\View\Components\uit;

use Closure;
use App\Models\Status;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class cableFilter extends Component
{
    private $statuses;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->statuses = Status::where('category_id', 2)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $statuses = $this->statuses;
        return view('components.uit.cable-filter', compact('statuses'));
    }
}
