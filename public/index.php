
<?php

require_once __DIR__ . "/../vendor/autoload.php";
use Pc\Blogapp\App\Router;
use Pc\Blogapp\Controller\HomeController;
use Pc\Blogapp\Controller\BlogController;
use Pc\Blogapp\Controller\UserController;
use Pc\Blogapp\Middleware\MustLoginMiddleware;
use Pc\Blogapp\Middleware\MustNotLoginMiddleware;
use Pc\Blogapp\Middleware\MustAdminMiddleware;




Router::add("GET", "/", HomeController::class , "index", []);
Router::add("GET", "/post/{id}", BlogController::class , "showBlog", []);

Router::add("GET", "/user/login", UserController::class, "login", [MustNotLoginMiddleware::class]);
Router::add("POST", "/user/login", UserController::class, "postLogin", [MustNotLoginMiddleware::class]);


Router::add("GET", "/user/register", UserController::class, "register", [MustNotLoginMiddleware::class]);
Router::add("POST", "/user/register", UserController::class, "postRegister", [MustNotLoginMiddleware::class]);

Router::add("GET", "/user/logout", UserController::class, "logout", [MustLoginMiddleware::class]);


Router::add("GET", "/add", BlogController::class, "createBlog", [MustAdminMiddleware::class]);
Router::add("POST", "/add", BlogController::class, "postCreateBlog", [MustAdminMiddleware::class]);




Router::run();