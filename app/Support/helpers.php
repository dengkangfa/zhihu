<?php

if( !function_exists('user') ) {
    /**
     * @param null $driver
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user($driver = null) {
        if(!is_null($driver)) {
            return app('auth')->guard($driver)->user();
        }

        return app('auth')->user();
    }
}