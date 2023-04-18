<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

trait IpToCountry
{
    public function getCountry($ip)
    {
        $request = Http::withHeaders([
            'Content-Type' => 'text/plain',
            'apikey' => '1rk7a8BXheo1vmRPnqqNGOV8VxArIxxJ'
        ])->get("https://api.apilayer.com/ip_to_location/$ip");
        return $request->json();
    }
}
