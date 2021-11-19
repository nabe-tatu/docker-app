<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //TODO::try catchじゃなくルート存在確認で書きたい
            try {

                return route($request->path());

            }catch (\Exception $e) {

                return route('login');
            }
        }
    }
}
