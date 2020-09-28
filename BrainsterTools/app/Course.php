<?php

namespace App;

use App\Filters\AllFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $with = ['userVotes', 'type', 'level', 'medium', 'language', 'subcategories'];

        public function user(){
            return $this->belongsTo(User::class);
        }

        public function type()
        {
            return $this->belongsTo(Type::class);
        }

        public function level()
        {
            return $this->belongsTo(Level::class);
        }

        public function medium()
        {
            return $this->belongsTo(Medium::class);
        }

        public function language()
        {
            return $this->belongsTo(Language::class);
        }

        public function versions()
        {
            return $this->belongsToMany(Version::class, 'courses_versions');
        }

        public function subcategories()
        {
            return $this->belongsToMany(Subcategory::class, 'courses_subcategories');
        }

        public function userVotes()
        {
            return $this->belongsToMany(User::class, 'courses_users', 'course_id', 'user_id');
        }

        public function scopeFilter(Builder $builder, $request)
        {
            return (new AllFilters($request))->filter($builder);
        }




}
