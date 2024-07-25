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
        return $this->blogRepository->getBlogs();
    }

    public function showById(int $id): ?BlogResponse {
        return $this->blogRepository->showById($id);
    }

    public function showCategories(){
        return $this->blogRepository->showCategory();
    }

    public function showTags(){
        return $this->blogRepository->showTag();
    }

    public function addPost($post, $categoryIds, $tagIds){
        return $this->blogRepository->addPost($post, $categoryIds, $tagIds);
    }

}