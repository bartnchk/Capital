<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CreditStep extends Model
{
    use \App\Traits\Scopes;

    protected $fillable = ['title_ru', 'title_uk', 'description_ru', 'description_uk', 'time_ru', 'time_uk', 'published'];
}