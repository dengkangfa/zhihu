<?php

namespace App\Repositories;

class BaseRepository
{
    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function byId($id)
    {
        return $this->model::find($id);
    }
}
