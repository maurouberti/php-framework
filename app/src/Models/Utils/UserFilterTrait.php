<?php

namespace App\Models\Utils;

trait UserFilterTrait 
{
    private $user_id;

    public function setUser($user_id)
    {
        $this->user_id = $user_id;
        $this->where('user_id', '=', $user_id);
    }

    public function create(array $data)
    {
        $data['user_id'] = $this->user_id;
        return parent::create($data);
    }
    
    public function update(array $data)
    {
        $data['user_id'] = $this->user_id;
        return parent::update($data);
    }
}
