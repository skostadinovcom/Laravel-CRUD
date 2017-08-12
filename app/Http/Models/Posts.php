<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    public function get_author()
    {
	    return $this->belongsTo('App\Http\Models\Users', 'author', 'id');
    }
}
