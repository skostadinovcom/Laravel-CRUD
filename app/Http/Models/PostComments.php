<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    protected $table = 'post_comments';

	public function get_author()
	{
		return $this->belongsTo('App\Http\Models\Users', 'author', 'id');
	}
}
