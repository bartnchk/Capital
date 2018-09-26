<?php

namespace App\Models\Admin;

use App\Models\Common\Tariff;
use Illuminate\Database\Eloquent\Model;

class TariffCategory extends Model
{
    use \App\Traits\Scopes;

    protected $fillable = ['title_ru', 'title_uk', 'description_ru', 'description_uk', 'published', 'alias'];

    public function tariffs()
    {
        return $this->hasMany(Tariff::class);
    }
}
