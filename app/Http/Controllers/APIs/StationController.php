<?php

namespace App\Http\Controllers\APIs;

use App\Models\Station;
use Illuminate\Http\Response;
use App\Specifications\Setting;
use Illuminate\Http\JsonResponse;
use App\Specifications\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Http\Resources\StationCollection;
use App\Http\Requests\StationsListRequest;
use App\Http\Requests\CreateStationRequest;
use App\Http\Requests\UpdateStationRequest;
use App\Services\Station\CreateStationService;
use App\Services\Station\DeleteStationService;
use App\Services\Station\UpdateStationService;
use App\Specifications\Station\NameSpecification;
use App\Specifications\Station\NullSpecification;
use App\Specifications\Station\CompanySpecification;
use App\Services\Station\GetPaginatedStationsListService;

class StationController extends Controller
{
    public function __construct(
        private GetPaginatedStationsListService $getPaginatedStationsListService,
        private CreateStationService $createStationInput,
        private DeleteStationService $deleteStationService,
        private UpdateStationService $updateStationService
    ) {
    }

    public function index(StationsListRequest $request)
    {
        $pagination = new Pagination(
            $request->query('page', 1),
            $request->query('perPage', Setting::PAGE_SIZE)
        );

        $specification = $this->buildSpecification($request);

        $companies = $this->getPaginatedStationsListService->get($specification, $pagination);

        return StationCollection::make($companies);
    }

    public function store(CreateStationRequest $request)
    {
        $station = $this->createStationInput->create($request->validated());

        $result = new StationResource($station);
        $result->response()->setStatusCode(Response::HTTP_CREATED);

        return $result;
    }

    public function update(UpdateStationRequest $request, Station $station)
    {
        $company = $this->updateStationService->update($request->validated(), $station);

        return new StationResource($company);
    }

    public function show(Station $station)
    {
        return new StationResource($station);
    }

    public function destroy(Station $station)
    {
        $this->deleteStationService->delete($station);

        return (new JsonResponse())->setStatusCode(Response::HTTP_NO_CONTENT);
    }

    private function buildSpecification(StationsListRequest $request)
    {
        $specification = new NullSpecification();
        if ($request->has('name')) {
            $specification = $specification->and(
                new NameSpecification($request->query('name'))
            );
        }
        if ($request->has('company_id')) {
            $specification = $specification->and(
                new CompanySpecification($request->query('company_id'))
            );
        }

        return $specification;
    }
}
