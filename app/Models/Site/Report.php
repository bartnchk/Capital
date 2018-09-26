<?php

namespace App\Models\Site;

use App\Models\Common\Document;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use \App\Traits\Scopes;

    protected $with = 'documents';

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function getRouteKeyName()
    {
        return 'alias';
    }

}