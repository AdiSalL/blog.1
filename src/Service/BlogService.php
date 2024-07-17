<?php

namespace Pc\Blogapp\Service;
use Pc\Blogapp\Repository\BlogRepository;

class BlogService {
    private BlogRepository $blogRepository;
    public function __construct(BlogRepository $blogRepository) {
        $this->blogRepository = $blogRepository;
    } 
    
    public function showAllPosts() {
        return $this->blogRepository->showAll();
    }

}