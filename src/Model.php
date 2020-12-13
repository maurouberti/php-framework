<?php

namespace PHP\Framework;

use Pimple\Container;

abstract class Model extends QueryBuilder
{
    protected $db;
    protected $events;
    protected $table;

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
        $this->events = $container['events'];
        if (!$this->table) {
            $table = explode('\\', get_called_class());
            $table = array_pop($table);
            $this->table = strtolower($table) . 's';
        }
    }

    public function find(int $id)
    {
        $query = $this->where('id', '=', $id)->sqlSelect($this->table)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $query = $this->sqlSelect($this->table)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function get()
    {
        $query = $this->sqlSelect($this->table)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $this->events->trigger('creating.' . $this->table, null, $data);

        $query = $this->sqlInsert($this->table, $data)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        $id = $this->db->lastInsertId();
        $result = $this->find($id);

        $this->events->trigger('created.' . $this->table, null, $result);

        return $result;
    }
    
    public function update(array $data)
    {
        $result = $this->get();

        $this->events->trigger('updating.' . $this->table, null, $data);

        $query = $this->sqlUpdate($this->table, $data)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute(array_values($query->bind));

        $this->events->trigger('updated.' . $this->table, null, $result);

        return $result;
    }

    public function delete()
    {
        $result = $this->get();

        $this->events->trigger('deleting.' . $this->table, null, $result);

        $query = $this->sqlDelete($this->table)->getData();
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        $this->events->trigger('deleted.' . $this->table, null, $result);

        return $result;
    }
}
