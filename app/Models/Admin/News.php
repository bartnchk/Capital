<?php

namespace App\Models\Admin;

use App\Models\Common\City;
use App\Models\Common\Image;
use App\Filters\NewsFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

//use App\Search\Searchable;

class News extends Model
{
    use \App\Traits\Scopes;
    use \App\Traits\HandleImage;
    use \App\Traits\Imageable;
//    use Searchable;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($news)
        {
            $news->images->each->delete();

            $news->deleteWithThumbnail($news->image, 'news');
        });
    }

    public function region()
    {
        return $this->belongsToMany(Region::class, 'news_regions');
    }

    public function city()
    {
        return $this->belongsToMany(City::class,'union_news');
    }

    public function getConditions($search)
    {
        return $this->where('title_ru', 'like', "%{$search}%")
            ->orWhere('description_ru', 'like', "%{$search}%")
            ->orWhere('title_uk', 'like', "%{$search}%")
            ->orWhere('description_uk', 'like', "%{$search}%");
    }

    public function storeUnionTable($request, $update = FALSE)
    {
        //dd($request->region_id);

        if( $request->region_id )
        {
            if($update)
                $this->region()->sync($request->region_id);
            else
                $this->region()->attach($request->region_id);

            if ( $request->city_id ) {

                if($update)
                    $this->city()->sync($request->city_id);
                else
                    $this->city()->attach($request->city_id);
            }
        }
    }

    public function getUnionTable()
    {
        $table = DB::table('union_news');

        $query = $table->leftJoin('cities', 'cities.id', '=', 'union_news.city_id')
            ->leftJoin('regions', 'regions.id', '=', 'cities.region_id')
            ->whereNewsId($this->id)
            ->get(['cities.id', 'cities.title_ru', 'regions.id as region_id']);

        return $query;
    }
}
