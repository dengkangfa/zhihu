<?php

namespace App\Repositories;

use App\Answer;

class AnswerRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Answer $model)
    {
        $this->model = $model;
    }

    public function getAnswerCommentsById($id)
    {
        $answer = Answer::with('comments', 'comments.user')->where('id', $id)->first();

        return $answer->comments;
    }
}
