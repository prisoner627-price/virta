<?php

namespace App\Http\Requests;

class UpdateStationRequest extends NoAuthorizationRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'lat' => ['sometimes', 'numeric', 'between:-90,90'],
            'long' => ['sometimes', 'numeric', 'between:-180,180'],
            'company_id' => ['sometimes', 'integer', 'exists:companies,id'],
            'address' => ['sometimes', 'string'],
        ];
    }
}
