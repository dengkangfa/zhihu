<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/topics', function (Request $request) {
    $topics = App\Topic::select('id', 'name')
                ->where('name','like','%'.$request->get('q').'%')
                ->get();
    return $topics;
})->middleware('api');

/**
 * 获取当前用户是否关注该问题
 * @var [type]
 */
Route::post('/question/follower', function(Request $request) {
    $user = Auth::guard('api')->user();
    $followed = $user->followed($request->get('question'));
    if($followed)
        return response()->json(['followed' => true]) ;
    return response()->json(['followed' => false]);
})->middleware('auth:api');

/**
 * 用户操作操作关注\取消关注
 * @var [type]
 */
Route::post('/question/follow', function(Request $request) {
    $user = Auth::guard('api')->user();
    $question = \App\Question::find($request->get('question'));
    $followed = $user->followThis($question->id);
    if(count($followed['detached'])){
        $question->decrement('followers_count');
        return response()->json(['followed' => false]) ;
    }
    $question->increment('followers_count');
    return response()->json(['followed' => true]);
})->middleware('auth:api');

Route::get('/user/followers/{id}', 'FollowersController@index');
Route::post('/user/follows', 'FollowersController@follow');
