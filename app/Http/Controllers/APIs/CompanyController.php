<?php

namespace App\Http\Controllers\APIs;

use App\Models\Company;
use Illuminate\Http\Response;
use App\Specifications\Setting;
use Illuminate\Http\JsonResponse;
use App\Specifications\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyCollection;
use App\Http\Requests\CompaniesListRequest;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\Company\CreateCompanyService;
use App\Services\Company\DeleteCompanyService;
use App\Services\Company\UpdateCompanyService;
use App\Specifications\Company\NameSpecification;
use App\Specifications\Company\NullSpecification;
use App\Services\Company\GetPaginatedCompaniesListService;

class CompanyController extends Controller
{
    public function __construct(
        private GetPaginatedCompaniesListService $getPaginatedCompaniesListService,
        private CreateCompanyService $createCompanyService,
        private UpdateCompanyService $updateCompanyService,
        private DeleteCompanyService $deleteCompanyService
    ) {
    }

    public function index(CompaniesListRequest $request)
    {
        $pagination = new Pagination(
            $request->query('page', 1),
            $request->query('perPage', Setting::PAGE_SIZE)
        );

        $specification = $this->buildSpecification($request);

        $companies = $this->getPaginatedCompaniesListService->get($specification, $pagination);

        return CompanyCollection::make($companies);
    }

    public function store(CreateCompanyRequest $request)
    {
        $company = $this->createCompanyService->create($request->validated());

        $result = new CompanyResource($company);
        $result->response()->setStatusCode(Response::HTTP_CREATED);

        return $result;
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company = $this->updateCompanyService->update($request->validated(), $company);

        return new CompanyResource($company);
    }

    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    public function destroy(Company $company)
    {
        $this->deleteCompanyService->delete($company);

        return (new JsonResponse())->setStatusCode(Response::HTTP_NO_CONTENT);
    }

    private function buildSpecification(CompaniesListRequest $request)
    {
        $specification = new NullSpecification();
        if ($request->has('name')) {
            $specification = $specification->and(
                new NameSpecification($request->query('name'))
            );
        }

        return $specification;
    }
}
