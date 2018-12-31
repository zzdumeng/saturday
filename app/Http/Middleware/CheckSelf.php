<?php

namespace App\Http\Middleware;

use Closure;
use \App\Models\User;

class CheckSelf
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
        // $user = User::find($request->input('id'));
        $user = User::find($request->route('id'));
        if (!$user) {
            return response(['error' => 'should have id input']);
        }

        $auser = auth()->user();
        if ($auser->id == $user->id || $auser->is_super) {
            return $next($request);
        }

        return response(['error' => 'you have no access right to this resource']);
    }
}
