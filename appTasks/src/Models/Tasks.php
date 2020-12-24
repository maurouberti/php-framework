<?php

namespace AppTasks\Models;

use PHP\Framework\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    public function getByProjectId(int $id)
    {
        $sql = 'select tasks.* 
        from tasks 
        left join sections on tasks.section_id = sections.id
        where sections.project_id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
