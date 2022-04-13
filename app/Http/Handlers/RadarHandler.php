<?php

namespace App\Http\Handlers;

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
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            "Authorization: {$secret}",
        ];
        $data = [
            'description' => $description ? $description : $tag,
            'type' => 'circle',
            'coordinates' => [$longitude, $latitude],
            'radius' => $radius,
        ];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        return self::runRequest($ch);
    }

    private static function runRequest($ch): array
    {
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($info['http_code'] == '200') {
            return ['success' => 1, 'data' => $result];
        } else {
            return [
                'success' => 0,
                'http_status' => $info['http_code'],
                'error' => $error,
                'response' => $result,
                'info' => $info,
            ];
        }
    }
}
