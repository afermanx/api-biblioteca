<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRentRequest;
use App\Http\Requests\RentRequest;
use App\Http\Resources\RentResource;
use App\Http\Resources\RentResourceCollection;
use App\Models\Rent;
use App\Traits\ApiResponse;
use Facades\App\Services\RentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RentController extends Controller
{
    use ApiResponse;

    /**
     * list all rents with oarams to paginate in the request
     *
     * @param ListRentRequest $request
     * @return JsonResponse
     */
    public function listAll(ListRentRequest $request): JsonResponse
    {
        $rents = RentService::listAll($request->validated());

        return $this->ok(new RentResourceCollection($rents));
    }

    /**
     * rent a book
     *
     * @param RentRequest $request
     * @return JsonResponse
     */
    public function rent(RentRequest $request): JsonResponse
    {
        $rent = RentService::rent($request->validated());
        return $this->ok(RentResource::make($rent));
    }

    /**
     * return a book
     *
     * @param int $id
     * @return JsonResponse
     */
    public function return(Rent $rent): JsonResponse
    {
        $rent = RentService::return($rent);
        return $this->ok(RentResource::make($rent));
    }
}
