<?php

namespace App\Models\Common;

use App\Traits\Scopes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    use Scopes;
    use \App\Traits\HandleImage;
    use \App\Traits\Imageable;

    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    protected $appends = ['city_location', 'link', 'image_path', 'details'];

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($office) {
            $office->images->each->delete();

            $office->deleteWithThumbnail($office->image, 'office');
        });
    }


    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function getImagePathAttribute()
    {
        if ($this->image)
            return '/storage/images/offices/' . $this->image;
    }

    public function getTimeStartAttribute($value)
    {
        if ($value){
            return Carbon::parse($value)->format('H:i');
        }
    }

    public function getTimeEndAttribute($value)
    {
        if ($value){
            return Carbon::parse($value)->format('H:i');
        }
    }

    public function getCityLocationAttribute()
    {
        $title = 'title_' . app()->getLocale();

        return app()->getLocale() == 'ru' ? 'г. ' . $this->city->$title : 'м. ' . $this->city->$title;
    }

    public function getLinkAttribute(){
        return 'departments/'.$this->number;
    }

    public function getDetailsAttribute(){
        return __('main.details');
    }

}
