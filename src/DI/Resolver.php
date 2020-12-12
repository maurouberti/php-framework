<?php

namespace PHP\Framework\DI;

class Resolver
{
    private $dependencies;

    public function resolveMethod($method, array $dependencies = [])
    {
        $this->dependencies = $dependencies;
        $info = new \ReflectionFunction($method);
        $params = $info->getParameters();
        $params = $this->resolveParameters($params);
        return call_user_func_array($info->getClosure(), $params);
    }

    public function resolveClass(string $class, array $dependencies = [])
    {
        $this->dependencies = $dependencies;
        $class = new \ReflectionClass($class);

        if (!$class->isInstantiable()) {
            throw new \Exception("{$class} não instanciavel.");
        }

        $contructor = $class->getConstructor();
        if (!$contructor) {
            return new $class->name;
        }

        $params = $contructor->getParameters();
        $params = $this->resolveParameters($params);
        return $class->newInstanceArgs($params);
    }

    private function resolveParameters(array $params)
    {
        $dependencies = [];
        foreach ($params as $param) {
            $dependency = $param->getClass();
            if ($dependency) {
                // Se o PARAM for uma CLASS
                $dependencies[] = $this->resolveClass($dependency->name, $this->dependencies);
            } else {
                // Se o PARAM for uma VAR
                $dependencies[] = $this->getDependencies($param);
            }
        }
        return $dependencies;
    }

    private function getDependencies(\ReflectionParameter $param)
    {
        if (isset($this->dependencies[$param->name])) {
            return $this->dependencies[$param->name];
        }

        if ($param->isDefaultValueAvailable()) {
            return $param->getDefaultValue();
        }

        throw new \Exception("{$param->name} não recebeu um valor válido.");
    }
}
