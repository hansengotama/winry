<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $apiHelper;

    public function __construct(ApiHelper $apiHelper)
    {
        $this->apiHelper = $apiHelper;
    }

    public function user(Request $request): JsonResponse
    {
        return $this->apiHelper->getResponse(200, Auth::user());
    }


    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if ($validator->fails()) {
            return $this->apiHelper->getErrorResponse(422, "Error Validation", $validator->errors());
        }

        $credentials = $request->only('email', 'password');
        $isValid = Auth::attempt($credentials);
        if (!$isValid) {
            return $this->apiHelper->getErrorResponse(400, "Credentials are not set correctly", null);
        }

        return $this->apiHelper->getResponse(200, ['token' => $request->user()->createToken('user')->plainTextToken]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return $this->apiHelper->getResponse(200, null);
    }
}
