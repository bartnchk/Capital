<?php

namespace App\Models\Admin;

use App\Models\Common\Document;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use \App\Traits\Scopes;
    use \App\Traits\HandleImage;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($report){

            $report->documents->each->delete();

            $report->deleteWithThumbnail($report->certificate, 'reports');
        });
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}