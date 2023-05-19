<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();

        return view('back.hotels.index',[
            'hotels' => $hotels,
        ]);
    }

    public function create()
    {
        return view('back.hotels.create',[
            'countries' => Country::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'cost' => 'required|numeric|decimal:0,2|gt:0',
            'duration' => 'required|min:3|max:100',
            'country_id' => 'required|integer|min:1',
            'photo' => 'sometimes|required|image|max:10240',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $hotel = new Hotel;
        // photo
        $photo = $request->photo;
        if ($photo) {
            $hotel->photo = $hotel->addPhoto($photo);
        }
        $hotel->title = $request->title;
        $hotel->cost = $request->cost;
        $hotel->duration = $request->duration;
        $hotel->country_id = $request->country_id;
        $hotel->save();

        return redirect()->route('hotel-index')
        ->with('ok', 'New hotel was added');
    }

    public function edit(Hotel $hotel)
    {
        return view('back.hotels.edit', [
            'hotel' => $hotel,
            'countries' => Country::all(),
        ]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'cost' => 'required|numeric|decimal:0,2|gt:0',
            'duration' => 'required|min:3|max:100',
            'country_id' => 'required|integer|min:1',
            'photo' => 'sometimes|required|image|max:10240',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // photo
        if ($request->delete == 1) {
            $hotel->deletePhoto();
            return redirect()->back();
        }

        $photo = $request->photo;
        if ($photo) {
            $hotel->deletePhoto();
            $hotel->photo =  $hotel->addPhoto($photo);
        }
        $hotel->title = $request->title;
        $hotel->cost = $request->cost;
        $hotel->duration = $request->duration;
        $hotel->country_id = $request->country_id;
        $hotel->save();

        return redirect()->route('hotel-index')
        ->with('ok', 'New hotel was added');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()
        ->route('hotel-index')
        ->with('info', 'Hotel was deleted');
    }
}
