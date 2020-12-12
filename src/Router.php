<?php

namespace PHP\Framework;

use PHP\Framework\Exceptions\HttpException;

class Router
{
    private $routes = [];

    /**
     * TODO: TRANSFORMAR EM HELPER
     */
    // $route: /route/{id:[0-9]+}/{nome}
    // $url: /route/123/ABC
    private function checkUrl(string $route, string $url): array
    {
        // $variables: Array( [0] => Array( [0] => {id:[0-9]+} [1] => {nome} ) [1] => Array( [0] => id:[0-9]+ [1] => nome ) )
        preg_match_all('/\{([^\}]*)\}/', $route, $variables);

        // $regex: '\/route\/{id:[0-9]+}\/{nome}'
        $regex = str_replace('/', '\/', $route);

        foreach ($variables[1] as $k => $variable) {
            // $k: 0 | $as: Array( [0] => id [1] => [0-9]+ )
            // $k: 1 | $as: Array( [0] => nome )
            $as = explode(':', $variable);
            // $k: 0 | $replacement: [0-9]+
            // $k: 1 | $replacement: ([a-zA-Z0-9\-\_\ ]+)
            $replacement = $as[1] ?? '([a-zA-Z0-9\-\_\ ]+)';
            // $k: 0 | $regex: \/regex\/[1-9]+\/{nome}
            // $k: 1 | $regex: \/regex\/[1-9]+\/([a-zA-Z0-9\-\_\ ]+)
            $regex = str_replace($variables[0][$k], $replacement, $regex);
            /*
            $regex = str_replace($variables[0], $replacement, $regex);
            $regex = str_replace($variables[$k], $replacement, $regex);
            */
        }
        /*
        $regex = preg_replace('/{([a-zA-Z]+)}/', '([a-zA-Z0-9+])', $regex);
        */
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
                return $callback($params);
            }
        }
        
        throw new HttpException('Página não encontrada', 404);
    }
}
