<?php

namespace Pc\Blogapp\App;


class Router
{

    private static array $routes = [];

    public static function add(string $method,
                               string $path,
                               string $controller,
                               string $function,
                               array $middlewares = []): void
    {
        $path = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $path);
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            "middleware" => $middlewares
        ];
    }

    public static function run(): void
    {
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $routePath = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route["path"]);
            if (preg_match("#^$routePath$#", $path, $matches) && $method == $route['method']) {

                foreach($route["middleware"] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }

                array_shift($matches);
                $function = $route['function'];
                $controller = new $route['controller'];
                call_user_func_array([$controller, $function], $matches);
                // $controller->$function();

                return;
            }
        }

        http_response_code(404);
        echo 'PAGE NOT FOUND';
    }

}

