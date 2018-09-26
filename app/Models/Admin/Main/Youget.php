<?php

namespace App\Models\Admin\Main;

use Illuminate\Database\Eloquent\Model;

class Youget extends Model
{
    use \App\Traits\HandleImage;

    protected $table = 'main_youget';
    protected $guarded = [];
}
