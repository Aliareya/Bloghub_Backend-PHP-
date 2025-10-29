<?php
namespace App\Routes;

class Routes
{
    private $routes = [];

    // ثبت مسیر
    public function add(string $method, string $path, callable $callback)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'callback' => $callback
        ];
    }

    // اجرای مسیر
    public function handle(string $requestUri, string $requestMethod)
    {
        $requestMethod = strtoupper($requestMethod);
        $requestUri = parse_url($requestUri, PHP_URL_PATH); // حذف query string

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) continue;

            $pattern = preg_replace('#\{[a-zA-Z_]+\}#', '([a-zA-Z0-9_-]+)', $route['path']);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches);
                return call_user_func_array($route['callback'], $matches);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
