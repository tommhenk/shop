<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function hasRole($name, $require = false){
        if (is_array($name)) {
            foreach ($name as $item) {
                $roleName = $this->hasRole($item);

                if ($roleName && !$reqire) {
                    return true;
                }else if (!$roleName && $reqire) {
                    return false;
                }
                return $reqire;
            }
        }else{
            foreach($this->roles as $role){
                if (\Str::is($name, $role->name)) {
                    return true;
                }
            }
        }
    }

    public function canDo($name, $require = false) {

        if (is_array($name)) {
            foreach ($name as $item) {
                $permName = $this->canDo($item);

                if (!$permName && $reqire) {
                    return false;
                } else if($permName && !$reqire){
                    return true;
                }
                return $reqire;
            }
        }else{
            // dd($this->roles);
            foreach($this->roles as $role){

                foreach ($role->perms as $permission){

                    if(\Str::is($name, $permission->name)){
                        return true;
                    }
                }
            }
            return false;
        }
    }
}
