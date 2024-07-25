<?php

namespace Pc\Blogapp\Controller;
use Pc\Blogapp\App\View;
use Pc\Blogapp\Service\BlogService;
use Pc\Blogapp\Database\Database;
use Pc\Blogapp\Repository\BlogRepository;
use Pc\Blogapp\Repository\UserRepository;
use Pc\Blogapp\Repository\SessionRepository;
use Pc\Blogapp\Service\UserService;
use Pc\Blogapp\Service\SessionService;



class BlogController {
    private BlogService $blogService;
    private UserRepository $userRepository;
    
    public function __construct() {
        $connection = Database::getConnection();
        $blogRepository = new BlogRepository($connection);
        $this->blogService = new BlogService($blogRepository);

        $this->userRepository = new UserRepository($connection);
        $this->userService = new UserService($this->userRepository);

        
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $this->userRepository);
    }
    public function showBlog($id) {
        $blogs = $this->blogService->showById($id);
        View::render("BlogPost/show", $model = [
            "blogs" => $blogs
        ]);
    }

    public function createBlog() {
        $blogCategory = $this->blogService->showCategories();
        $blogTag = $this->blogService->showTags();
        
        View::render("BlogPost/add", $model = [
            "blogCategory" => $blogCategory,
            "blogTag" => $blogTag
        ]);
    }
    
    public function postCreateBlog(){
        $user = $this->sessionService->current();
     
        $userName = $this->userRepository->findById($user->id);
        $post = [
            "title" => $_POST["title"],
            "content" => $_POST["content"],
            "author" => $userName->name,
            
        ];

        $categoryIds = $_POST["category_ids"] ?? [];
        
        $tagIds = $_POST["tag_ids"] ?? [];
        
        try {
            $this->blogService->addPost($post, $categoryIds, $tagIds);

            View::redirect("/");
        }catch(ValidationException $exception){
            View::render("BlogPost/add", $model = [
            "error" => $exception->getMessage() 
            ]);
        }
   
    }
}