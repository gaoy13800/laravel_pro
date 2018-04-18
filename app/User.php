<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'agent_manage_users';

    protected $primaryKey = 'userId';

    protected $fillable = [
        'account',
        'password',
        'roleName',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPassword(){
        return $this->password;
    }
}
