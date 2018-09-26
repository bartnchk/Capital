<?php

namespace App\Models\Common;

use App\Models\Admin\Region;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use Scopes;

    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    protected $fillable = [
        'title_ru',
        'description_ru',
        'title_uk',
        'description_uk',
        'published',
        'category_id',
        'region_id',
        'city_id',
        'salary',
        'link',
        'created_at',
        'updated_at',
    ];

    public function category(){
        return $this->belongsTo(VacancyCategory::class);
    }

    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function city(){
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
