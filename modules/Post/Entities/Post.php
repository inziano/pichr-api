<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
    * The table associated with the model
    *
    * @var string
    * 
    * Always explicitly define this to avoid database collisions
    */
    protected $table = 'posts';

    protected $fillable = ['title','description','number_of_views','storage_id','categories_id','user_id'];
}
