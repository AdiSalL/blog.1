<?php

 namespace Pc\Blogapp\App;

 class View {
    public static function render($view, $model) {
        require_once __DIR__ . "/../View/" . $view . ".php";
    }
 }




?>