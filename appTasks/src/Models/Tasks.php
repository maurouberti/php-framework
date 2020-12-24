<?php

namespace AppTasks\Models;

use PHP\Framework\Model;
use App\Models\Utils\UserFilterTrait;

class Tasks extends Model
{
    use UserFilterTrait;

    protected $table = 'tasks';

    public function getByProjectId(int $id)
    {
        $sql = 'select tasks.* 
        from tasks 
        left join sections on tasks.section_id = sections.id
        where sections.project_id = ? and tasks.user_id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id, $this->user_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $data['user_id'] = $this->user_id;
        $data['assigned_to'] = $this->user_id;
        return parent::create($data);
    }
}
