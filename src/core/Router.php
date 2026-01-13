<?php

namespace App\core;

class Router
{
    private array $routes = [
        "GET" => [],
        "POST" => []
    ];
    public function get(string $path, $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }
    public function post(string $path, $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }
    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $path => $callback) {
            $routeRegex = preg_replace_callback('/{\w+(:([^}]+))?}/', function ($matches) {
                return isset($matches[2]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
            }, $path);
            $pattern = '@^' . $routeRegex . '$@';
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                if (is_callable($callback)) {
                    return call_user_func_array($callback, $matches);
                }
                if (is_array($callback)) {
                    [$class, $methodName] = $callback;
                    if (class_exists($class)) {
                        $controller = new $class();
                        return call_user_func_array([$controller, $methodName], $matches);
                    }
                }
            }
        }
        http_response_code(404);
        if(isset($this -> routes["GET"]['/404']))
            {
                return call_user_func($this -> routes["GET"]['/404']);
            }
            echo "404 - page non trouve";
    }
}
