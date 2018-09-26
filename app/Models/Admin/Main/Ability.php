<?php

namespace App\Models\Admin\Main;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use \App\Traits\HandleImage;

    protected $table = 'main_abilities';
    protected $guarded = [];
}