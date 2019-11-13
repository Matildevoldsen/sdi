<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fields = ['title_dk', 'title_en', 'content_en', 'content_dk', 'category_id', 'meta_title_dk', 'meta_title_en', 'meta_desc_dk', 'meta_desc_en', 'thumbnail', ''];
    public function category()
    {
    	return $this->belongsToMany('App\Category');
    }
}
