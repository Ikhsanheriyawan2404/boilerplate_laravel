<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

trait HandleFailedValidation
{
    protected function failedValidation(Validator $validator): HttpResponseException
    {
        if ($this->expectsJson()) {
            (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                response()->json([
                    'data' => null,
                    'meta' => [
                        'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'status' => 'Unprocessable Entity',
                        'message' => 'Data yang dimasukkan tidak valid!',
                        'errors' => $validator->errors(),
                    ],
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
