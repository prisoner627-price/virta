<?php

namespace Tests\Feature\Company;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Testing\TestResponse;

class CompaniesListTest extends TestCase
{
    public function test_get_list_of_companies()
    {
        Company::factory()->count(10)->create();
        $page = 1;
        $perPage = 10;
        $uri = route('companies.index', [
            'perPage' => $perPage,
            'page' => $page,
        ]);

        $response = $this->getJson($uri);

        $response->assertSuccessful();
        $this->assertResponseStructure($response);
        $this->assertPagination($response, $perPage, $page);
    }

    public function test_get_list_of_companies_filtered_by_name()
    {
        Company::factory()->create(['name' => 'first']);
        Company::factory()->create(['name' => 'second']);
        Company::factory()->create(['name' => 'third']);
        Company::factory()->create(['name' => 'fourth']);
        $page = 1;
        $perPage = 10;
        $uri = route('companies.index', [
            'perPage' => $perPage,
            'page' => $page,
            'name' => 'ir',
        ]);

        $response = $this->getJson($uri);

        $response->assertSuccessful();
        $response->assertJsonCount(2, 'data');
        $this->assertResponseStructure($response);
    }

    private function assertResponseStructure(TestResponse $response)
    {
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'parent',
                    'created_at',
                    'updated_at',
                ],
            ],
        ], $response->getData(true));
    }

    private function assertPagination(TestResponse $response, $perPage, $currentPage)
    {
        $response->assertJson([
            'meta' => [
                'current_page' => $currentPage,
                'per_page' => $perPage,
            ],
        ]);
    }
}
