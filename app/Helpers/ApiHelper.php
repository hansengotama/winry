<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiHelper
{
    public function getErrorResponse(int $code, string $message, $description = null) : JsonResponse
    {
        return response()->json([
            'error'   => [
                'code'        => $code,
                'message'     => $message,
                'description' => $description
            ],
            'data'    => null
        ], $code);
    }

    public function getResponse(int $code, $data = null) : JsonResponse
    {
        return response()->json([
            'error'   => null,
            'data'    => $data
        ], $code);
    }
}