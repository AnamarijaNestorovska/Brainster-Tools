<?php

namespace App\Filters;
class VersionFilter
{
    public function filter($builder, $value)
    {
        $builder->whereHas('versions', function($q) use ($value) {
            return $q->where('version_id', $value);
        });
    }
}
?>
