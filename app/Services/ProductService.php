<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function all()
    {
        return Product::all();
    }

    /**
     * @param int $id
     *
     * @return Product
     */
    public function getOne(int $id)
    {
        return Product::findOrFail($id);
    }

    /**
     * @param int $id
     *
     * @return Builder[]|Collection
     */
    public function getOneWithCategories(int $id)
    {
        return Product::with('category')->findOrFail($id);
    }
}
