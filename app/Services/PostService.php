<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function all()
    {
        return Post::all();
    }

    public function getOne(int $id)
    {
        return Post::findOrFail($id);
    }
}
