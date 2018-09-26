<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use \App\Traits\Scopes;

    protected $fillable = ['title_ru', 'title_uk', 'description_ru', 'description_uk', 'faq_category_id', 'published'];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}
