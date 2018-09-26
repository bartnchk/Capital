<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use \App\Traits\Scopes;

    protected $fillable = ['title_ru', 'title_uk', 'alias', 'published'];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

//    public function setAliasAttribute($value)
//    {
//        $this->attributes['alias'] = $this->attributes['title_ru'];
//        $this->attributes['alias'] = str_slug($value);
//    }
}
