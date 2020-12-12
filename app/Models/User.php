<?php

namespace App\Models;

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function find(int $id)
    {
        $sql = 'select * from users where id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
