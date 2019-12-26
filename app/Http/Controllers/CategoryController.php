<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoriesResource;
use App\Http\Resources\Category\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return CategoriesResource::collection($this->categoryService->all());
    }

    /**
     * Display the specified resource.
     *
     * @param integer $productId Product id.
     *
     * @return CategoryResource
     */
    public function show(int $productId)
    {
        return new CategoryResource($this->categoryService->getOneWith($productId));
    }
}
