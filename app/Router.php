<?php

declare(strict_types=1);

namespace App;

use App\Attributes\Route;
use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function __construct(private Container $container)
    {
    }

    public function registerRoutesFromControllerAttributes(array $controllers)
    {
        foreach($controllers as $controller) {
            $reflectionController = new \ReflectionClass($controller);

            foreach($reflectionController->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF);

                foreach($attributes as $attribute) {
                    $route = $attribute->newInstance();

                    $this->register($route->method, $route->routePath, [$controller, $method->getName()]);
                }
            }
        }
    }

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }
    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    # [REQUEST_URI] = /contact?foo=bar
    # [REQUEST_URI] = /user?id=1
    public function resolve($requestUri, string $requestMethod)
    {
        $route = explode('?', $requestUri)[0]; // /contact lub /user
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }

        //bez tego metody w kontrolerach muszą być statyczne
        if (is_callable($action)) {
            return call_user_func($action);
        }
        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
                $class = $this->container->get($class);

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                    
                }
            }
        }
        throw new RouteNotFoundException();
    }
}