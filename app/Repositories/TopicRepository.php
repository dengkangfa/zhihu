<?php


namespace App\Repositories;

use Illuminate\Http\Request;
use App\Topic;

class TopicRepository
{
    public function getTopicsForTagging(Request $request)
    {
        return Topic::select('id', 'name')
            ->where('name','like','%'.$request->get('q').'%')
            ->get();
    }
}