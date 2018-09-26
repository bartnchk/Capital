<?php

namespace App\Models\Admin;

use App\Models\Common\City;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use \App\Traits\Scopes;

    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'title_ru',
        'title_uk',
        'published'
    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'region_id', 'id');
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_regions');
    }

}
