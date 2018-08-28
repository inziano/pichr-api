<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use Notifiable;

    /**
     * Table associated with the model
     * 
     * @var string
     * 
     * Explicitly define this to avoid database collisions 
     */
    protected $table = 'user';

    /**
     * Mass assignable attributes 
     * 
     * @var array
     */

    protected $fillable = ['username','email','password'];

    /**
     * The attributes that should be hidden for arrays
     * 
     * @var array 
     */
    protected $hidden = ['password', 'remember_token'];
}
