<?php

require_once __DIR__ . "/../vendor/autoload.php";
use Pc\Blogapp\App\Router;
use Pc\Blogapp\Controller\HomeController;

Router::add("GET", "/", HomeController::class , "index");

Router::run();