<?php

namespace App\Services;

use App\Models\Category;
use App\Traits\ApiException;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    use ApiException;

    /**
     * This function returns a paginated list of all categories
     *
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function listAll(array $data): LengthAwarePaginator
    {
        $perPage = $data['perPage'] ?? 10;
        return Category::paginate($perPage);
    }

    /**
     * It creates a new category.
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        $category = Category::create($data);
        if (!$category) {
            $this->badRequestException(['error' => 'Unable to register the category.']);
        }
        return $category;
    }

    /**
     * It updates the category.
     *
     * @param Category $category
     * @param array $data
     * @return Category
     */
    public function update(Category $category, array $data): Category
    {
        tap($category)->update($data);
        if (!$category) {
            $this->badRequestException(['error' => 'Unable to update the category.']);
        }
        return $category;
    }
}
