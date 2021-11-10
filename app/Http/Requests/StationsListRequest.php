<?php

namespace App\Http\Requests;

class StationsListRequest extends NoAuthorizationRequest
{
    public function rules(): array
    {
        return [
            'page' => ['integer'],
            'perPage' => ['integer'],
            'name' => ['string'],
        ];
    }
}
