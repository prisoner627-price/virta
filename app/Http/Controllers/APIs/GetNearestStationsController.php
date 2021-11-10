<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetNearestStationsRequest;
use App\Services\Station\GetNearestStationsService;

class GetNearestStationsController extends Controller
{
    public function __construct(private GetNearestStationsService $getNearestStationsService)
    {
    }

    public function get(GetNearestStationsRequest $getNearestStationsRequest)
    {
        $nearestStationsOutputs = $this->getNearestStationsService->get(
            $getNearestStationsRequest->distance,
            $getNearestStationsRequest->lat,
            $getNearestStationsRequest->long,
            $getNearestStationsRequest->company_id
        );

        $result = [];
        foreach ($nearestStationsOutputs as $nearestStationsOutput) {
            $result[] = $nearestStationsOutput->toArray();
        }

        return response()->json([
            'data' => $result,
        ]);
    }
}
