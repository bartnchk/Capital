<?php

namespace App\Models\Common;

use App\Models\Admin\News;
use App\Models\Admin\Action;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use \App\Traits\HandleImage;

    protected $guarded = [];
//    protected $with = 'parent';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($image){

            $image->deleteWithThumbnail($image->path, $image->parent_type);
        });
    }

    public function parent()
    {
        return $this->morphTo();
    }
}
