<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRentRequest;
use App\Http\Requests\RentRequest;
use App\Http\Resources\RentResource;
use App\Http\Resources\RentResourceCollection;
use App\Traits\ApiResponse;
use Facades\App\Services\RentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RentController extends Controller
{
    use ApiResponse;

    public function listAll(ListRentRequest $request): JsonResponse
    {
        $rents = RentService::listAll($request->validated());

        return $this->ok(new RentResourceCollection($rents));
    }

    public function rent(RentRequest $request): JsonResponse
    {

        $rent = RentService::rent($request->validated());

        return $this->ok(RentResource::make($rent));
    }
}
