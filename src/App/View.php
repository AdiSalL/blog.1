<?php

 namespace Pc\Blogapp\App;

 class View {
    public static function render($view, $model) {
        require_once __DIR__ . "/../View/header" . ".php";
        require_once __DIR__ . "/../View/" . $view . ".php";
        require_once __DIR__ . "/../View/footer" . ".php";
    }

    public static function redirect ($link) {
        header("Location: " . $link);
    } 
 }




?>