<?php

namespace Tests\Feature\Company;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Http\Response;

class DeleteCompanyTest extends TestCase
{
    private const ROUTE_NAME = 'companies.destroy';

    public function test_send_not_found_response_in_deleting_not_exists_company()
    {
        $response = $this->deleteJson(route(self::ROUTE_NAME, ['company' => time()]));

        $response->assertNotFound();
    }

    public function test_successful_delete_company()
    {
        $company = Company::factory()->create();

        $response = $this->deleteJson(route(self::ROUTE_NAME, ['company' => $company->getKey()]));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDeleted('companies', ['id' => $company->getKey()]);
    }
}
