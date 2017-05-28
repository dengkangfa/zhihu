<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    private $allowed = ['city', 'bio'];

    /**
     * @var User
     */
    private $user;

    /**
     * Setting constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function merge(array $attributes)
    {
        $setting = array_merge($this->user->settings, array_only($attributes, $this->allowed));

        return $this->user->update(['settings' => $setting]);
    }
}
