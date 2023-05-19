<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();

        return view('front.index',[
            'hotels' => $hotels,
        ]);
    }
}
