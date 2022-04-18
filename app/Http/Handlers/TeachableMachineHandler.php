<?php

namespace App\Http\Handlers;

class TeachableMachineHandler
{
    /**
     * Get list of class names with teachable machine API
     *
     * @param $link
     * @return array
     */
    public static function getClassNames($link): array
    {
        $url = $link . '/metadata.json';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = self::runRequest($ch);
        if (!$response['success']) {
            return $response;
        }
        $list = [];
        foreach (json_decode($response['data'])->labels as $label) {
            $list[] = [$label, $label];
        }
        return $list;
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
