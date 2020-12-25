<?php

namespace AppSchedules\Models;

use PHP\Framework\Model;
use App\Models\Utils\UserFilterTrait;

class Schedules extends Model
{
    use UserFilterTrait;
    
    protected $table = 'schedules';
}
