<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function answer() {
        return $this->hasMany('App\Answer','comment_id');
    }
}
