<?php

namespace App\Http\Controllers;

use App\Jobs\DispatchWeather;
use App\Models\City;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    public function __invoke($city)
    {
        $forecastData = [];
        $location = City::where('name', $city)->first();

        if (!$location) {
            Log::error('This name of city does not exist in your database');
        }

        try {
            Cache::remember('weather', 60 * 5, function () use ($forecastData, $location) {
                $response = Http::timeout(120)->get("api.openweathermap.org/data/2.5/forecast?q={$location->name}&appid=" . env('API_KEY') . "&units=metric");

                $data = json_decode($response, true);

                foreach ($data['list'] as $val) {
                    $dt_txt = date_create_from_format('Y-m-d H:i:s', $val['dt_txt']);

                    $forecastData[] = [
                        'dt' => $val['dt'],
                        'temp' => $val['main']['temp'],
                        'dt_txt' => $dt_txt,
                        'city_id' => $location->id
                    ];
                }

                dispatch(new DispatchWeather($forecastData));
            });
        } catch (Exception $e) {
            Log::error(
                [
                    'location' => $location ?? 0,
                    'message' => __($e->getMessage()),
                ]
            );
        }
    }
}
