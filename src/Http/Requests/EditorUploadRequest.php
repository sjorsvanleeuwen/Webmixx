<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class EditorUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'upload' => [
                'required',
                'file',
                'image',
                'max:3072',
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $response = response()->json([
                'error' => [
                    'message' => $validator->errors()->first()
                ],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

            throw (new ValidationException($validator, $response))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }

        parent::failedValidation($validator);
    }
}
