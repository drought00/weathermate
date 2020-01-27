<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\WeatherApi as WeatherApi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $weatherApi;

    public function __construct(WeatherApi $weatherApi)
    {
        $this->weatherApi = $weatherApi;
    }

    public function index()
    {
        $city = "Osaka";
        $countryCode = "JP";
        $weather = $this->weatherApi->getCurrentWeatherOf($city,$countryCode);
        $forecast = $this->weatherApi->getForecastOf($city,$countryCode);
        return view('content', [
            'weather' => $weather,
            'forecast' => $forecast
        ]);
    }

    public function searchWeather(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_code' => 'required',
            'city' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/')->withErrors('search');
        }
        $weather = $this->weatherApi->getCurrentWeatherOf($request->input('city'),$request->input('country_code'),$request->input('name'));
        $forecast = $this->weatherApi->getForecastOf($request->input('city'),$request->input('country_code'));
        return view('content', [
            'weather' => $weather,
            'forecast' => $forecast
        ]);
    }
}