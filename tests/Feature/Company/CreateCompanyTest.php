<?php

namespace Tests\Feature\Company;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Http\Response;

class CreateCompanyTest extends TestCase
{
    private const ROUTE_NAME = 'companies.store';

    public function test_successful_creation()
    {
        $company = Company::factory()->make();

        $response = $this->postJson(route(self::ROUTE_NAME), $company->toArray());

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'parent',
                'created_at',
                'updated_at',
            ],
        ], $response->getData(true));
        $this->assertDatabaseHas('companies', $company->toArray());
    }

    public function test_impossible_to_create_company_with_invalid_parent()
    {
        $company = Company::factory()->make([
            'parent_id' => time()
        ]);

        $response = $this->postJson(route(self::ROUTE_NAME), $company->toArray());

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure(['errors' => ['parent_id']]);
        $this->assertDatabaseMissing('companies', $company->toArray());
    }
}
