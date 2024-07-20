
<?php

require_once __DIR__ . "/../vendor/autoload.php";
use Pc\Blogapp\App\Router;
use Pc\Blogapp\Controller\HomeController;
use Pc\Blogapp\Controller\BlogController;
use Pc\Blogapp\Controller\UserController;



Router::add("GET", "/", HomeController::class , "index");
Router::add("GET", "/post/{id}", BlogController::class , "showBlog");

Router::add("GET", "/user/login", UserController::class, "login");
Router::add("POST", "/user/login", UserController::class, "postLogin");


Router::add("GET", "/user/register", UserController::class, "register");
Router::add("POST", "/user/register", UserController::class, "postRegister");





Router::run();