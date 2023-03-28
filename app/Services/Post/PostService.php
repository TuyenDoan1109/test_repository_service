<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepositoryInterface;
use App\Services\BaseService;

class PostService extends BaseService implements PostServiceInterface
{
    public function __construct(PostRepositoryInterface $postRepository) {
        $this->repository = $postRepository;
    }
}



