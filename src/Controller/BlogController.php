<?php

namespace Pc\Blogapp\Controller;

use Pc\Blogapp\App\View;

class BlogController {
    public function showBlog($id) {
        View::render("BlogPost/show", $model = [
            "id" => $id,
        ]);
    }
}