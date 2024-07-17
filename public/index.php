<?php

require_once __DIR__ . "/../vendor/autoload.php";
use Pc\Blogapp\App\Router;
use Pc\Blogapp\Controller\HomeController;
use Pc\Blogapp\Controller\BlogController;


Router::add("GET", "/", HomeController::class , "index");
Router::add("GET", "/post/{id}", BlogController::class , "showBlog");


Router::run();