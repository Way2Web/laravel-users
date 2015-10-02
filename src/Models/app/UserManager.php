<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\User as DefaultUserModel;
use App\UserManager as MeSelf;

class UserManager extends DefaultUserModel
{    
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get all the roles that belong to this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
    
    public static function hasRoles(array $roles)
    {
        $loginUser = \Auth::user();
        $user = MeSelf::where('email', '=', $loginUser->email)->first();
        foreach($roles as $role) {
            if(in_array($role, $user->roles->lists('name')->toArray())) {
                return true;
            }
        }
        return false;
    }
}