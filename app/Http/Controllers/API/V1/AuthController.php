<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $http422 = Response::HTTP_UNPROCESSABLE_ENTITY;

    public function login()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            $result = new ApiResource($this->http422, Response::$statusTexts[422], $validator->errors(),
                null);
            return response()->json($result, $this->http422);
        }

        if (! auth()->attempt(request()->only('email', 'password'))) {
            return response()->json(new ApiResource(401, false, 'Gagal. email/password salah!'), 401);
        }

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        $data = [
            'token' => $token,
            'user' => auth()->user(),
        ];

        return new ApiResource(200, true, 'Berhasil login.', $data);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return new ApiResource(200, true, 'Berhasil logout.', null);
    }
}
