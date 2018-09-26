<?php

namespace App\Traits;

trait Scopes
{

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}