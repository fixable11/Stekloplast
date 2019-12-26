<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductsResource;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ProductsResource::collection($this->productService->all());
    }

    /**
     * Display the specified resource.
     *
     * @param integer $productId Product id.
     *
     * @return ProductResource
     */
    public function show(int $productId)
    {
        return new ProductResource($this->productService->getOneWithCategories($productId));
    }
}
