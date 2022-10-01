<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateInstitutionRequest;
use App\Http\Resources\InstitutionResource;
use App\Traits\ApiResponse;
use Facades\App\Services\InstitutionService;

class InstitutionController extends Controller
{
    use ApiResponse;
    public function create(CreateInstitutionRequest $request): JsonResponse
    {

        $institution = InstitutionService::create($request->validated());
        return $this->ok(new InstitutionResource($institution));
    }
}
