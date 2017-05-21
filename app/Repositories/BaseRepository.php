<?php

namespace App\Repositories;

class BaseRepository
{
    public function create(array $data)
    {
        return $this->model::create($data);
    }
}
