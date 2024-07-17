<?php

namespace Pc\Blogapp\Controller;

use Pc\Blogapp\App\View;

class BlogController {
    public function showBlog() {
        View::render("BlogPost/show", $model = [
      
        ]);
    }
}