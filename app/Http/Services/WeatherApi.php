<?php

namespace App\Http\Services;

use App\Http\Services\Api; 

class WeatherApi extends Api
{
    public function getCurrentWeatherOf($city, $countryCode, $name = null)
    {
        $config = config('services.openweather');
        $url = $config['domain'].'data/2.5/weather';
        $param = array(
            'q' => $city.','.$countryCode,
            'appid' => $config['appid'],
            'units' => $config['units']
        );
        $result = $this->get($url,$param);
        return array(
            'temperature' => $result['main']['temp'],
            'temperature_max' => $result['main']['temp_max'],
            'temperature_min' => $result['main']['temp_min'],
            'description' => $result['weather'][0]['description'],
            'location' => $name ? $name.", ".$result['name'] : $result['name']
        );

    }

    public function getForecastOf($city, $countryCode)
    {
        $config = config('services.openweather');
        $url = $config['domain'].'data/2.5/forecast';
        $param = array(
            'q' => $city.','.$countryCode,
            'appid' => $config['appid'],
            'units' => $config['units'],
            'cnt' => 12
        );
        $result = $this->get($url,$param);
        $items = array();
        foreach($result['list'] as $item)
        {
            $date = date_create($item['dt_txt']);
            $_item = array(
                'date' => date_format($date, 'M j'),
                'time' => date_format($date, 'h:i A'),
                'temp' => $item['main']['temp'],
                'icon' => $item['weather'][0]['icon'],
                'description' => $item['weather'][0]['description'],
            );
            array_push($items,$_item);
        }
        return array(
            "list" => $items,
            "city" => $result['city']
        );    
    }
}
