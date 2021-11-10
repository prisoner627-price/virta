<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends NoAuthorizationRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('companies', 'id'),
            ],
        ];
    }
}
