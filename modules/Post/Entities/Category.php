<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * The table associated with the model
    *
    * @var string
    * 
    * Always explicitly define this to avoid database collisions
    */
    protected $table = 'categories';

    protected $fillable = ['category_name','description'];

}
