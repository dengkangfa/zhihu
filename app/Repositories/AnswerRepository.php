<?php

namespace App\Repositories;

use App\Answer;

class AnswerRepository extends BaseRepository
{
    protected $model;

    public function __construct(Answer $model)
    {
        $this->model = $model;
    }
}
