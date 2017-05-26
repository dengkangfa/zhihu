<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Auth;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{

    private $question;

    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;

        $this->middleware('auth');
    }

    public function follow($question)
    {
        Auth::user()->followThis($question);

        return back();
    }

    public function follower(Request $request)
    {
        $followed = user('api')->followed($request->get('question'));
        if($followed)
            return response()->json(['followed' => true]) ;
        return response()->json(['followed' => false]);
    }

    public function followThisQuestion(Request $request)
    {
        $question = $this->question->byId($request->get('question'));
        $followed = user('api')->followThis($question->id);
        if(count($followed['detached'])){
            $question->decrement('followers_count');
            return response()->json(['followed' => false]) ;
        }
        $question->increment('followers_count');
        return response()->json(['followed' => true]);
    }
}
