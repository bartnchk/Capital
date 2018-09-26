<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ActionImage extends Model
{
    protected $guarded = [];

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
