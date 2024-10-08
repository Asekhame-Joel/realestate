<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use DB;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getPermissionGroup(){
        $permissionGroup = DB::table('permissions')
        ->select('group_name')
        ->groupBy('group_name')
        ->get();
        return $permissionGroup;
    }

    public static function getPermissionName($group_name){
        $permissionName = DB::table('permissions')
        ->select('name','id')
        ->where('group_name', $group_name)
        ->get();
        return $permissionName;
    }
    public static function roleHasPermission($roles, $permissionName){
        $hasPermission = true;
        foreach($permissionName as $prems){
            if(!$roles->hasPermissionTo($prems->id)){
                $hasPermission = false;
            }
            
            return $hasPermission; 
        }

    }



}
