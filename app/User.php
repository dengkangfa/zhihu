<?php

namespace App;

use Mail;
use Naux\Mail\sendCloudTemplate;
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
