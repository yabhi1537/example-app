<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function weather(Request $request)
    {
        $weatherResponse = [];
        if($request->city !== -1){

           $cityName = $request->city;

           $response = Http::withHeaders([
            "X-RapidAPI-Host" => "open-weather13.p.rapidapi.com",
            "X-RapidAPI-Key" => "e91d87baf5msh5b76076a81bf027p172ae2jsn6e92c377fc9a"
           ])->get("https://open-weather13.p.rapidapi.com/city/{$cityName}/EN");

           $weatherResponse = $response->json();
        }
        return view("weather", [
            "data" => $weatherResponse
        ]);
    } 

}
