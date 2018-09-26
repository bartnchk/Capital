<?php

namespace App\Models\Admin;

use App\Models\Common\Image;
use App\Rewards;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use \App\Traits\Scopes;
    use \App\Traits\HandleImage;
    use \App\Traits\Imageable;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($page){

            $page->deleteImage($page->image, 'page');
        });
    }

}
