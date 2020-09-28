<?php

// TypeFilter.php

namespace App\Filters;

class LanguageFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('language_id', $value);
    }
}
