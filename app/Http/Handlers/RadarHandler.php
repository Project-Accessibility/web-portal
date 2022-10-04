<?php

namespace App\Http\Handlers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class RadarHandler
{
    /**
     * Create geofence with Radar API
     *
     * @param $id
     * @param $longitude
     * @param $latitude
     * @param $radius
     * @return array
     */
    public static function saveGeofence(
        $id,
        $tag,
        $description,
        $longitude,
        $latitude,
        $radius,
    ): array {
        $url = env('RADAR_API_URL') . "/geofences/{$tag}/{$id}";
        $secret = env('RADAR_SECRET');

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => $secret,
        ];

        $data = [
            'description' => $description ?? $tag,
            'type' => 'circle',
            'coordinates' => [$longitude, $latitude],
            'radius' => $radius,
        ];

        $response = Http::withHeaders($headers)
            ->asForm()
            ->put($url, $data);

        $response->onError(function (Response $response) {
            return [
                'success' => 0,
                'http_status' => $response->status(),
                'error' => $response->body(),
                'response' => $response,
            ];
        });

        return ['success' => 1, 'data' => $response->body()];
    }
}
