<?php

namespace Tests\Feature\Admin\Project;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Http\Response;

class UpdateCompanyTest extends TestCase
{
    private const ROUTE_NAME = 'companies.update';

    public function test_send_not_found_response_in_updating_not_exists_company()
    {
        $response = $this->patchJson(route(self::ROUTE_NAME, ['company' => time()]));

        $response->assertNotFound();
    }

    public function test_successful_update_company()
    {
        $company = Company::factory()->create([
            'name' => 'test',
        ]);
        $newData = [
            'name' => 'test test',
        ];

        $response = $this->patchJson(
            route(
                self::ROUTE_NAME,
                ['company' => $company->getKey()]
            ),
            $newData
        );

        $response->assertSuccessful();
        $this->assertDatabaseHas(
            'companies',
            array_merge(
                ['id' => $company->getKey()],
                $newData,
            ),
        );
    }

    public function test_impossible_to_update_company_with_invalid_parent_id()
    {
        $company = Company::factory()->create();
        $newData = [
            'parent_id' => time(),
        ];

        $response = $this->patchJson(
            route(
                self::ROUTE_NAME,
                ['company' => $company->getKey()]
            ),
            $newData
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure(['errors' => ['parent_id']]);
        $this->assertDatabaseMissing(
            'companies',
            array_merge(
                ['id' => $company->getKey()],
                $newData,
            ),
        );
    }
}
