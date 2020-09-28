<?php

// TypeFilter.php

namespace App\Filters;

class MediumFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('medium_id', $value);
    }
}
