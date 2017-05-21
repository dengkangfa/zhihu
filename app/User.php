<?php

namespace App;

use Mail;
use Naux\Mail\sendCloudTemplate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * 判断该模型对应的内容是否是该用户发表的
     * @param  Model  $model
     * @return boolean
     */
    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }

    public function follows()
    {
        return $this->belongsToMany(Question::class, 'user_question')->withTimestamps();
    }

    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    /**
     * 判断用户是否已关注
     * @param  int $question 问题
     * @return int
     */
    public function followed($question)
    {
        return $this->follows()->where('question_id', $question)->count();
    }

    public function sendPasswordResetNotification($token)
    {
        $data = [
            'url' => url('password/reset', $token),
        ];

        $template = new sendCloudTemplate('zhihu_password_reset',$data);

        Mail::raw($template, function ($message){
            $message->from('lingnanxy@aliyun.com', 'dkf');
            $message->to($this->email);
        });
    }
}
