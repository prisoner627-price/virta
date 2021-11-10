<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class NoAuthorizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    abstract public function rules(): array;
}
