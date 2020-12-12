<?php

namespace PHP\Framework;

use PHP\Framework\Exceptions\HttpException;

class Router
{
    private $routes = [];

    private function checkUrl(string $route, string $url): array
    {
        preg_match_all('/\{([^\}]*)\}/', $route, $variables);

        $regex = str_replace('/', '\/', $route);

        foreach ($variables[1] as $k => $variable) {
            $as = explode(':', $variable);
            $replacement = $as[1] ?? '([a-zA-Z0-9\-\_\ ]+)';
            $regex = str_replace($variables[0][$k], $replacement, $regex);
        }
        $result = preg_match('/^' . $regex . '$/', $url, $params);
        return compact('result', 'params');
    }

    private function getCurrentMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    private function getCurrentUrl(): string
    {
        $url = $_SERVER['PATH_INFO'] ?? '/';
        $url = strlen($url) > 1 ? rtrim($url, '/') : $url;
        return $url;
    }

    private function request(string $method, string $route, $callback): void
    {
        $method = strtolower($method);
        $this->routes[$method][$route] = $callback;
    }

    public function get(string $route, $callback): void
    {
        $this->request('get', $route, $callback);
    }

    public function post(string $route, $callback): void
    {
        $this->request('post', $route, $callback);
    }

    public function run()
    {
        $method = $this->getCurrentMethod();
        $url = $this->getCurrentUrl();

        if (empty($this->routes[$method])) {
            throw new HttpException('Página não encontrada', 404);
        }

        foreach ($this->routes[$method] as $route => $callback) {
            extract($this->checkUrl($route, $url));
            if ($result) {
                return compact('callback', 'params');
            }
        }
        
        throw new HttpException('Página não encontrada', 404);
    }
}
