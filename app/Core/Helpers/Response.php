<?php

namespace App\Core\Helpers;

/**
 * Helper to format responses
 * all methods return a json response
 */
class Response
{
    public static function success(array $data = null, int $status = 200)
    {
        return response()->json($data, $status);
    }

    public static function error(int $status = 500, string $message = 'Unexpected error', array $data = null)
    {
        return response()->json(compact(['message', 'data']), $status);
    }
}
