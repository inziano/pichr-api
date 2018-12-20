<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Downloads extends Model
{
    protected $fillable = ['post_id','user_id'];
}
