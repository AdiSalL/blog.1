<?php

namespace Pc\Blogapp\Service;
use Pc\Blogapp\Repository\BlogRepository;
use Pc\Blogapp\Model\BlogResponse;


class BlogService {
    private BlogRepository $blogRepository;
    public function __construct(BlogRepository $blogRepository) {
        $this->blogRepository = $blogRepository;
    } 
    
    public function showAllPosts() {
        return $this->blogRepository->showAll();
    }

    public function showById(int $id): ?BlogResponse {
        return $this->blogRepository->showById($id);
    }

}