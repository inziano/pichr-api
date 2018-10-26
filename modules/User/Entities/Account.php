<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    
    /**
     * Table associated with the model
     * 
     * @var string
     * 
     * Explicitly define this to avoid database collisions 
     */
    protected $table = 'accounts';

    protected $fillable = ['first_name','last_name','dob','gender','city','country','twitter','facebook','instagram','website','user_id'];
}
