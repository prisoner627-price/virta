<?php

namespace App\Http\Requests;

class CreateStationRequest extends NoAuthorizationRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'long' => ['required', 'numeric', 'between:-180,180'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'address' => ['required', 'string'],
        ];
    }
}
