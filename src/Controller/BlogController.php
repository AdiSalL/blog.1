<?php

namespace Pc\Blogapp\Controller;
use Pc\Blogapp\App\View;
use Pc\Blogapp\Service\BlogService;
use Pc\Blogapp\Database\Database;
use Pc\Blogapp\Repository\BlogRepository;


class BlogController {
    private BlogService $blogService;
    
    public function __construct() {
        $connection = Database::getConnection();
        $blogRepository = new BlogRepository($connection);
        $this->blogService = new BlogService($blogRepository);
    }
    public function showBlog($id) {
        $blogs = $this->blogService->showById($id);
        View::render("BlogPost/show", $model = [
            "blogs" => $blogs
        ]);
    }
    
}