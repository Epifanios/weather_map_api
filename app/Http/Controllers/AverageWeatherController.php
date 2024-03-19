<?php

namespace App\Http\Controllers;

use App\Models\Forecast;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AverageWeatherController extends Controller
{
    public function getAverage(Request $request)
    {
        $query = Forecast::query();

        $query->where('city_id', $request->city_id);

        if (!empty($request->start_date)) {
            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);
        }

        if (!empty($request->end_date)) {
            $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);
        }

        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('dt_txt', [$start_date, $end_date]);
        } else if (!empty($request->start_date)) {
            $query->where('dt_txt', '>=', $start_date);
        } else if (!empty($request->end_date)) {
            $query->where('dt_txt', '<=', $end_date);
        };

        return response()->json(['avg' => $query->avg('temp')]);
    }
}
