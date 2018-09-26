<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use \App\Traits\HandleImage;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($document){

            $document->deleteDocument($document->path, 'documents');
        });
    }
}
