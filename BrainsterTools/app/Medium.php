<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
