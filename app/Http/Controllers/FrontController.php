<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
 
    public function reserve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        if(Reservation::where('user_id', $request->user()->id)->where('hotel_id', $request->hotel_id)->first())
        {
            return redirect()
            ->back()
            ->with('ok', 'Already have this request');
        }

        $reservation = new Reservation;
        $reservation->hotel_id = $request->hotel_id;
        $reservation->user_id = $request->user()->id;
        $reservation->save();

        return redirect()
        ->back()
        ->with('ok', 'Hotel request was sent');
    }

    public function reservation(Request $request)
    {
        $userHotels = Reservation::where('user_id', $request->user()->id)->pluck('hotel_id');
        $hotels = Hotel::whereIn('id', $userHotels)->get();
        foreach($hotels as $h) {
            $h->approved = $h->reservations()->whereIn('user_id', $request->user())->first()->approved;
        }

        return view('front.reservations',[
            'hotels' => $hotels,
        ]);
    }
}
