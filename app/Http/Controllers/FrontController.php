<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort ?? '';
        $filter = $request->filter ?? '';
        $per = (int) ($request->per ?? 10);
        $page = $request->page ?? 1;

        $countries = Country::where('id', $filter)->pluck('id')->all();

        if ($filter == 0 || $filter ===''){
            $hotels = Hotel::where('id', '>', 0);
        } else {
            $hotels = Hotel::whereIn('country_id', $countries);
        }

        $hotels = match($sort) {
            'title_asc' => $hotels->orderBy('title'),
            'title_desc' => $hotels->orderBy('title', 'desc'),
            default => $hotels->orderBy('title')
        };

        // pagination
        $hotels = $hotels->paginate($per)->withQueryString();

        return view('front.index',[
            'hotels' => $hotels,
            'sortSelect' => Hotel::SORT,
            'sort' => $sort,
            'filterSelect' => Country::pluck('title')->all(),
            'filter' => $filter,
            'perSelect' => Hotel::PER,
            'per' => $per,
            'page' => $page,
        ]);
    }
}
