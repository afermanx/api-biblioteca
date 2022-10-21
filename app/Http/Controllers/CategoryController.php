<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;

class CategoryController extends Controller
{
    use ApiResponse;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * This function returns a paginated list of all categories
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listAll(Request $request): JsonResponse
    {
        $categories = $this->categoryService->listAll($request->only('perPage'));
        return $this->ok(new CategoryResourceCollection($categories));
    }

    /**
     * this function creates a new category
     *
     * @param Request $request
     * @return void
     */
    public function create(CategoryCreateRequest $request): JsonResponse
    {
        $category = $this->categoryService->create($request->validated());
        return $this->ok(new CategoryResource($category));
    }

    /**
     * This function updates a category
     *
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): JsonResponse
    {
        $category = $this->categoryService->update($category, $request->only('name'));
        return $this->ok(new CategoryResource($category));
    }

    /**
     * This function deletes a category
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->ok(['message' => 'Categoria removida com sucesso.']);
    }
}
