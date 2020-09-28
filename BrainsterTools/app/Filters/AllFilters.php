<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class AllFilters extends AbstractFilter
{
    protected $filters = [
        'type_id' => TypeFilter::class,
        'medium_id' => MediumFilter::class,
        'level_id' => LevelFilter::class,
        'version_id' => VersionFilter::class,
        'language_id' => LanguageFilter::class,
    ];
}
