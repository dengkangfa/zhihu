<?php


namespace App\Repositories;


use App\Message;

class MessageRepository
{
    use BaseRepository;

    private $model;

    /**
     * MessageRepository constructor.
     */
    public function __construct(Message $message)
    {
        $this->model = $message;
    }
}