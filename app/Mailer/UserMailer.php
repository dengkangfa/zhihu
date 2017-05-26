<?php


namespace App\Mailer;

use Auth;
use App\User;

class UserMailer extends Mailer
{
    public function FollowNotifyEmail($email)
    {
        $data = [
            'url' => '/',
            'name' => Auth::guard('api')->user()->name
        ];

        $this->sendTo('zhihu_follow_notification', $email, $data);
    }

    public function passwordReset($email, $token)
    {
        $data = [
            'url' => url('password/reset', $token),
        ];

        $this->sendTo('zhihu_password_reset', $email, $data);
    }

    public function welcome(User $user)
    {
        $data = [
            'url' => route('email.verify',['token' => $user->confirmation_token]),
            'name' => $user->name
        ];

        $this->sendTo('zhihu_register', $user->email, $data);
    }
}