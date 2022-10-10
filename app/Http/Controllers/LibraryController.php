<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpadateLibraryRequest;
use App\Models\Library;
use App\Traits\ApiResponse;
use Facades\App\Services\LibraryService;
use Illuminate\Http\JsonResponse;

class LibraryController extends Controller
{
    use ApiResponse;
    public function update(Library $library, UpadateLibraryRequest $request): JsonResponse
    {
       $library = LibraryService::update($library, $request->validated());
       return $this->ok($library);
    }
}
