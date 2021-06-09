<?php

namespace App\Model\admin;



use App\Traits\HasRolesAndPermissions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class admin extends Authenticatable
{
    use Notifiable,HasRolesAndPermissions;   
    protected $fillable=[
        'name','email','password','status','phone','role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role_name(){
         return $this->hasOne('App\Role','id','role_id');
    }
    
  

}