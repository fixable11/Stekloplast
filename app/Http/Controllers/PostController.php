<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostsResource;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PostsResource::collection($this->postService->all());
    }

    /**
     * Display the specified resource.
     *
     * @param integer $productId Product id.
     *
     * @return PostResource
     */
    public function show(int $productId)
    {
        return new PostResource($this->postService->getOne($productId));
    }
}
