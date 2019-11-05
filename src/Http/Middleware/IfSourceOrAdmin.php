<?php

namespace Way2Web\Users\Http\Middleware;

use Config;
use Closure;

class IfSourceOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userModel = config('entrance.classes.user_model');
        if ($userModel::hasRoles(['admin']) OR $userModel::hasRoles(['source'])) {
            return $next($request);
        }
        $request->session()->flash('message', 'U heeft niet de juiste rechten om de gezochte pagina te bekijken.');
        return \Redirect::route('login.index');
    }
}