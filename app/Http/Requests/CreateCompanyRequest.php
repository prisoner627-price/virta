<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CreateCompanyRequest extends NoAuthorizationRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', Rule::exists('companies', 'id')],
        ];
    }
}
