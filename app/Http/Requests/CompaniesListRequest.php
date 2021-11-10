<?php

namespace App\Http\Requests;

class CompaniesListRequest extends NoAuthorizationRequest
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
