<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use \App\Traits\Scopes;
    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    protected $fillable = [
        'name',
        'body',
        'city',
        'date'
    ];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }

    public function getDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
