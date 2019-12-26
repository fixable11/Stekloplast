<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function all()
    {
        return Category::with('products')->get();
    }

    public function getOne(int $id)
    {
        return Category::findOrFail($id);
    }

    public function getOneWithParentCategories(int $id)
    {
        return Category::with('parent')->findOrFail($id);
    }

    public function getOneWithProducts(int $id)
    {
        return Category::with('products')->findOrFail($id);
    }
}
