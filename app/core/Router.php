<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable|string $action): void
    {
        $this->addRoute('GET', $path, $action);
    }

    public function post(string $path, callable|string $action): void
    {
        $this->addRoute('POST', $path, $action);
    }

    private function addRoute(string $method, string $path, callable|string $action): void
    {
        $this->routes[$method][trim($path, '/')] = $action;
    }

    public function dispatch(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $uri = str_replace('/public', '', $uri);
        $uri = trim($uri, '/');

        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $route => $action) {
            
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                
                array_shift($matches);
                
                $this->resolve($action, $matches);
                return;
            }
        }

        echo "404 - Page Not Found";
    }

    private function resolve(callable|string $action, array $params): void
    {
        if (is_callable($action)) {
            call_user_func_array($action, $params);
            return;
        }

        if (is_string($action)) {
            [$controllerName, $method] = explode('@', $action);

            $controllerClass = "App\\Controllers\\" . $controllerName;

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();

                if (method_exists($controller, $method)) {
                    call_user_func_array([$controller, $method], $params);
                    return;
                }
            }
        }

        echo "Error: Controller or Method not found!";
    }
}