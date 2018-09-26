<?php

namespace App\Models\Common;

use App\Models\Admin\TariffCategory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use \App\Traits\Scopes;
    use \App\Traits\HandleImage;

    protected $guarded = [];
    protected $table = 'tariffs';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($tariff){

            $tariff->deleteImage($tariff->image, 'tariffs');
        });
    }

    public function category()
    {
        return $this->belongsTo(TariffCategory::class, 'tariff_category_id');
    }

}
