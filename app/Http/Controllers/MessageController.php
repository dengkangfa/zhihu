<?php

namespace App\Http\Controllers;

use Auth;
use App\Repositories\MessageRepository;

class MessageController extends Controller
{
    protected $message;

    /**
     * MessageController constructor.
     * @param $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
    }

    public function store()
    {
        $message = $this->message->create([
            'to_user_id' => request('user'),
            'from_user_id' => user('api')->id,
            'body' => request('body')
        ]);

        if($message) {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}