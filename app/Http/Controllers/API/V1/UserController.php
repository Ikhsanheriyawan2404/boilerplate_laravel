<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($id)
    {
        return new ApiResource(
            Response::HTTP_OK,
            Response::$statusTexts[200],
            'Detail User',
            User::with('company')->find($id),
        );
    }
}
