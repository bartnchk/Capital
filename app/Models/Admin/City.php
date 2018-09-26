<?php

namespace App\Models\Common;

use App\Models\Admin\News;
use App\Models\Admin\Region;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use Scopes;

    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'title_ru',
        'title_uk',
        'region_id',
        'published'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
    public function news ()
    {
        return $this->belongsToMany(News::class, 'union_news');
    }
}
