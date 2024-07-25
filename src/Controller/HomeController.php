<?php

namespace Pc\Blogapp\Controller;
use Pc\Blogapp\App\View;
use Pc\Blogapp\Service\BlogService;
use Pc\Blogapp\Service\SessionService;
use Pc\Blogapp\Database\Database;
use Pc\Blogapp\Repository\BlogRepository;
use Pc\Blogapp\Repository\UserRepository;
use Pc\Blogapp\Repository\SessionRepository;


class HomeController {
    
    private BlogService $blogService;
    private SessionService $sessionService;

    public function __construct() {
        $connection = Database::getConnection();
        $blogRepository = new BlogRepository($connection);
        $this->blogService = new BlogService($blogRepository);

        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function index() {
        $blogs = $this->blogService->showAllPosts();
        $user = $this->sessionService->current();
        if($user == null) {
            View::render("Home/index", $model = [
                "title" => "Home",
                "description" => "Hi, Welcome To Adi Blog",
                "blogs" => $blogs
            ]);
        }else {
            View::render("Home/index", $model = [
                "title" => "Home",
                "description" => "Hi, Welcome To Adi Blog" . "</br>" .  $user->name ,
                "blogs" => $blogs
            ]);
        }

    }
}