<?php

namespace App\Traits\Admin;

use App\Models\Status;

trait StatusTraits
{
    public function status($id)
    {
        $status = Status::where('category_id', $id)->get();
        return $status;
    }
}
