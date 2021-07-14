<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class DependentDropdownController extends Controller
{
    public function index()
    {
        $provinces = Province::pluck('name', 'id');

        return view('dependent-dropdown.index', [
            'provinces' => $provinces,
        ]);
    }

    public function city($id)
    {
        $cities = City::where('province_id', $id)
            ->pluck('name', 'id');

        return response()->json($cities);
    }

    public function district($id)
    {
        $district = District::where('city_id', $id)
            ->pluck('name', 'id');

        return response()->json($district);
    }

    public function village($id)
    {
        $village = Village::where('district_id', $id)
            ->pluck('name', 'id');

        return response()->json($village);
    }
}
