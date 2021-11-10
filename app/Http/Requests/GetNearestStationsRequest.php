<?php

namespace App\Http\Requests;

class GetNearestStationsRequest extends NoAuthorizationRequest
{
    public function rules(): array
    {
        return [
            'distance' => ['required', 'numeric', 'min:0'],
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'long' => ['required', 'numeric', 'between:-180,180'],
            'company_id' => ['sometimes', 'integer', 'exists:companies,id'],
        ];
    }
}
