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

    public function getOneWith(int $id)
    {
        return Category::with(['products', 'parent', 'child'])->findOrFail($id);
    }
}
