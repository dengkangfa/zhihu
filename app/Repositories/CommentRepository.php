<?php


namespace App\Repositories;


use App\Comment;

/**
 * @property Comment model
 */
class CommentRepository
{
    use BaseRepository;

    private $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}