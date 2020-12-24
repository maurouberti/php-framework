<?php

namespace AppTasks\Models;

use PHP\Framework\Model;
use App\Models\Utils\UserFilterTrait;

class Sections extends Model
{
    use UserFilterTrait;
    
    protected $table = 'sections';
}
