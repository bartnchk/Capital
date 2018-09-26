<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use \App\Traits\Scopes;
    use \App\Traits\HandleImage;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($banner){

            $banner->deleteImage($banner->image, 'banners');
        });
    }

}
