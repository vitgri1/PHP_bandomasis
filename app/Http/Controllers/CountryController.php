<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return view('back.countries.index',[
            'countries' => $countries,
        ]);
    }

    public function create()
    {
        return view('back.countries.create');
    }

    public function store(Request $request)
    {
        $country = new Country;
        $country->title = $request->title;
        $country->season = $request->season;
        $country->save();

        return redirect()->route('country-index')
        ->with('ok', 'New country was added');
    }

    public function edit(Country $country)
    {
        return view('back.countries.edit', [
            'country' => $country
        ]);
    }

    public function update(Request $request, Country $country)
    {
        $country->title = $request->title;
        $country->season = $request->season;
        $country->save();
        return redirect()->route('country-index')
        ->with('ok', 'Country was updated');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()
        ->route('country-index')
        ->with('info', 'Country was deleted');
    }
}
