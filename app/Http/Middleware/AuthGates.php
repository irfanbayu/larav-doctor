<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\ManagementAccess\Roles;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // get all user by session browser
        $users = \Auth::users();

        // checking validation middleware
        // system on or not
        // user active or not
        if(!app()->runningInConsole() && $users){
            $roles = Roles::with('permissions')->get();
            $permissionArray = [];

            // nested loop
            // looping for role (where table role)
            foreach ($roles as $role){
                //looping for permission (where table role_permissions)
                foreach ($role->permissions as $permissions){
                    $permissionArray[$permissions->title][] = $role->id;
                }
            }
            // check user role
            foreach ($permissionArray as $title => $roles){
                Gate::define($title, function (\App\Model\User $user)
                use ($roles) {
                    return count (array_intersect($user->role->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }
        // return all middleware
        return $next($request);
    }
}
