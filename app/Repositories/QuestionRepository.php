<?php

namespace App\Repositories;



use App\Question;
use App\Topic;

class QuestionRepository
{
    use BaseRepository;

    /**
     * @var Question
     */
    protected $model;


    public function __construct(Question $question)
    {
        $this->model = $question;
    }

    public function byIdWithTopicsAndAnswers($id)
    {
        return $this->model::where('id', $id)->with(['topics', 'answers'])->first();
    }

    public function getQuestionsFeed()
    {
        return $this->model::published()
                ->latest('updated_at')
                  ->with('user')
                    ->get();
      }

    /**
     * 过滤用户选择的话题，将所有话题转换成为对应的id
     * @param  array  $topics [选择的话题]
     * @return array         [话题对应的id数组]
     */
    public function normalizeTopic(array $topics)
    {
        //将数组转换集合，再调用集合的map方法
        return collect($topics)->map(function ($topic) {
            if(is_numeric($topic)) {
                Topic::find($topic)->increment('questions_count');
                return (int)$topic;
            }
            $topic = Topic::create(['name' => $topic, 'question_count' => 1]);
            return $topic->id;
        })->toArray();
    }

    public function getQuestionCommentsById($id)
    {
        $question = Question::with('comments', 'comments.user')->where('id', $id)->first();

        return $question->comments;
    }
}
