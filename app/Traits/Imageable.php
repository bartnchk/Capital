<?php

namespace App\Traits;

use App\Models\Common\Image;
use Illuminate\Database\Eloquent\Model;


trait Imageable
{
    // связь с моделью новостей, акций и т.д.
    public function images()
    {
        return $this->morphMany(Image::class, 'parent');
    }
    /**
     * Создание записи в таблице images, привязанной к новости, акции или т.д.
     */
    public function addImage($path, $title_ru = null, $title_uk = null)
    {
        return $this->images()->create(['path' => $path]);
    }
}