<?php

namespace App\Models\Site;

use App\Models\Common\Tariff;
use Illuminate\Database\Eloquent\Model;

class TariffCategory extends Model
{
    use \App\Traits\Scopes;

    protected $with = 'tariffs';

    public function tariffs()
    {
        return $this->hasMany(Tariff::class);
    }

//    public function getRouteKeyName()
//    {
//        return 'alias';
//    }
}
