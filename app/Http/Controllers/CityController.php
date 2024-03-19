<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $city = City::create($request->all());
        return response()->json($city, 201);
    }
}
