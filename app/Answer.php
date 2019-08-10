<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function comment() {
        return $this->belongsTo('App\Comment');
    }
}
