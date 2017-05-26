<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * @var
     */
    private $model;

    /**
     * TopicsController constructor.
     */
    public function __construct(TopicRepository $topic)
    {
        $this->model = $topic;
    }

    public function index(Request $request)
    {
        return $this->model->getTopicsForTagging($request);
    }
}
