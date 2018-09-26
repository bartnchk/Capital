<?php

namespace App\Models\Admin\Main;

use Illuminate\Database\Eloquent\Model;

class Bail extends Model
{
    use \App\Traits\HandleImage;

    protected $table = 'main_bail';
    protected $guarded = [];
}
