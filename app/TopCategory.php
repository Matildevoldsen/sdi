<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopCategory extends Model
{
    protected $table = "top_categories";
    public function category() {
        return $this->hasOne('App\Category');
    }
}
