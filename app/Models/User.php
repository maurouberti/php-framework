<?php

namespace App\Models;

use Pimple\Container;

class User
{
    private $db;
    private $events;

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
        $this->events = $container['events'];
    }

    public function find(int $id)
    {
        $sql = 'select * from users where id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $this->events->trigger('creating.users', null, $data);
        // inserir no BD
        $this->events->trigger('created.users', null, $data);
    }
}
