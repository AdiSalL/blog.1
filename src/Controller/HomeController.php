<?php

namespace Pc\Blogapp\Controller;
use Pc\Blogapp\App\View;
use Pc\Blogapp\Service\BlogService;
use Pc\Blogapp\Database\Database;
use Pc\Blogapp\Repository\BlogRepository;

class HomeController {
    private BlogService $blogService;
    
    public function __construct() {
        $connection = Database::getConnection();
        $blogRepository = new BlogRepository($connection);
        $this->blogService = new BlogService($blogRepository);
    }

    public function index() {
        $blogs = $this->blogService->showAllPosts();
        View::render("Home/index", $model = [
            "title" => "Home",
            "description" => "Welcome to my blog",
            "blogs" => $blogs
        ]);
    }
}