<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswerRepository;

class AnswersController extends Controller
{
    protected $answer;

    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function store(StoreAnswerRequest $request, $question)
    {
        $answer = $this->answer->create([
            'question_id' => $question,
            'user_id' => Auth::id(),
            'body' => $request->get('body')
        ]);

        $answer->question()->increment('answers_count');

        return back();
    }
}