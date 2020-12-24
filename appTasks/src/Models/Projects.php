<?php

namespace AppTasks\Models;

use PHP\Framework\Model;
use App\Models\Utils\UserFilterTrait;

class Projects extends Model
{
    use UserFilterTrait;
    
    protected $table = 'projects';
}
