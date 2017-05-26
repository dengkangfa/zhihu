<?php


namespace App\Mailer;

use Mail;
use Naux\Mail\sendCloudTemplate;

/**
 * Class Mailer
 * @package App\Mailer
 */
class Mailer
{
    /**
     * @param $template
     * @param $email
     * @param $data
     */
    protected function sendTo($template, $email, $data)
    {
        $content = new sendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use ($email) {
            $message->from('1316107553@qq.com', 'dkf');
            $message->to($email);
        });
    }
}