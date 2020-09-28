<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
