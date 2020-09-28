<?php

// TypeFilter.php

namespace App\Filters;

class LevelFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('level_id', $value);
    }
}
