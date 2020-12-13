<?php

namespace PHP\Framework;

abstract class CrudController
{
    abstract protected function getModel(): string;

    public function index($container, $request)
    {
        return $container[$this->getModel()]->get();
    }

    public function show($container, $request)
    {
        $id = $request->attributes->get(1);
        return $container[$this->getModel()]->where('id', '=', $id)->first();
    }

    public function create($container, $request)
    {
        $data = $request->request->all();
        return $container[$this->getModel()]->create($data);
    }

    public function update($container, $request)
    {
        $id = $request->attributes->get(1);
        $data = $request->request->all();
        return $container[$this->getModel()]->where('id', '=', $id)->update($data);
    }

    public function delete($container, $request)
    {
        $id = $request->attributes->get(1);
        return $container[$this->getModel()]->where('id', '=', $id)->delete($id);
    }
}
