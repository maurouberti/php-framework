<?php

namespace AppTasks\Models;

use PHP\Framework\Model;
use App\Models\Utils\UserFilterTrait;

class Subtasks extends Model
{
    use UserFilterTrait;
    
    protected $table = 'subtasks';
}
