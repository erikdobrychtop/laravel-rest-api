<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
    public function __construct()
    {
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (! empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        // Loga o erro no arquivo laravel.log
        Log::error('Erro SGFor: ' . (is_array($error) ? json_encode($error) : $error), [
            'error_messages' => $errorMessages, 
            'status_code' => $code
        ]);

        return response()->json($response, $code);
    }
}