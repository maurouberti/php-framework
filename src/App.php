<?php

namespace PHP\Framework;

use PHP\Framework\Exceptions\HttpException;
use PHP\Framework\Modules\Registry;
use PHP\Framework\Response;
use PHP\Framework\Router;
use Pimple\Container;

class App
{
    private $composer;
    private $container;
    private $middlewares = [
        'before' => [],
        'after' => []
    ];

    private function loadRegistry($modules)
    {
        $registry = new Registry;
        $registry->setApp($this);
        $registry->setComposer($this->composer);

        foreach ($modules as $file => $module) {
            require $file;
            $registry->add(new $module);
        }
        $registry->run();
    }

    public function __construct($composer, array $modules)
    {
        $this->composer = $composer;
        $this->container = new Container;
        $this->loadRegistry($modules);
    }

    public function middleware(string $on, $callback)
    {
        $this->middlewares[$on][] = $callback;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function getRouter()
    {
        if (!$this->container->offsetExists('router')) {
            $this->container['router'] = function () {
                return new Router;
            };
        }
        return $this->container['router'];
    }

    public function getResponder()
    {
        if (!$this->container->offsetExists('responder')) {
            $this->container['responder'] = function () {
                return new Response;
            };
        }
        return $this->container['responder'];
    }

    public function getHttpErrorHandler()
    {
        if (!$this->container->offsetExists('httpErrorHandler')) {
            $this->container['httpErrorHandler'] = function ($container) {
                header('Content-Type: application/json');
                $response = json_encode([
                    'code' => $container['exception']->getCode(),
                    'error' => $container['exception']->getMessage(),
                ]);
                return $response;
            };
        }
        return $this->container['httpErrorHandler'];
    }

    public function run()
    {
        try {
            $result = $this->getRouter()->run();
            $response = $this->getResponder();
            $params = [
                'container' => $this->container,
                'params' => $result['params']
            ];
            foreach ($this->middlewares['before'] as $middleware) {
                $middleware($this->container);
            }
            $response($result['callback'], $params);
            foreach ($this->middlewares['after'] as $middleware) {
                $middleware($this->container);
            }
        } catch (HttpException $e) {
            $this->container['exception'] = $e;
            echo $this->getHttpErrorHandler();
        }
    }
}
