<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test extends Controller
{
    public function roler()
    {
        try {
            $roles = 'test';
            return response()->json(['roles' => $roles]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
