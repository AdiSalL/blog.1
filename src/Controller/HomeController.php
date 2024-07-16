<?php

namespace Pc\Blogapp\Controller;
use Pc\Blogapp\App\View;

class HomeController {
    public function index() {
        View::render("Home/index", $model = [
            "title" => "Home",
            "description" => "Welcome to my blog"
        ]);
    }
}