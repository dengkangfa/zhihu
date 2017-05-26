<?php

namespace App\Repositories;

trait BaseRepository
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
