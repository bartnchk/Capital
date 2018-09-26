<?php

namespace App\Models\Admin;

use App\Models\Common\City;
use App\Models\Common\Image;
use Illuminate\Database\Eloquent\Model;
// use App\Search\Searchable;
use Illuminate\Support\Facades\DB;

class Action extends Model
{
    use \App\Traits\Scopes;
    use \App\Traits\HandleImage;
    use \App\Traits\Imageable;
//    use Searchable;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($action) {

            $action->images->each->delete();

            $action->deleteWithThumbnail($action->image, 'action');
        });
    }

    /**
     * @param $data
     * @param $request
     *
     * @return bool
     */
    public function saveAction($data, $request)
    {
        if (isset($data['photo'])) {
            $data['photo'] = $this->saveImage($data['photo'], 'action', 418, 320);
        }

        if (isset($data['wide_photo'])) {
            $data['wide_photo'] = $this->saveImage($data['wide_photo'], 'action', 1300, 440);
        }

        $data['alias'] = $data['alias'] ? $data['alias'] : str_slug($data['title_ru']);

        $data['start_at']  = date('Y-m-d', strtotime($data['start_at']));
        $data['finish_at'] = date('Y-m-d', strtotime($data['finish_at']));

        unset($data['_method']);
        unset($data['_token']);
        unset($data['region_id']);
        unset($data['city_id']);
        unset($data['url']);

        if (isset($data['gallery'])) {
            unset($data['gallery']);
        }

        $this->fill($data);

        $status = $this->save();

        $this->storeUnionTable($request);

        if ($request->has('gallery')) {
            foreach ($request->gallery as $image) {
                // создали картинку, запись на диск, возвращает filename.jpeg
                $imageName = $this->saveWithThumbnail($image, 'action', 1300, 1000, 276, 212);

                // создали запись в таблице images
                $this->addImage($imageName);
            }
        }

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function city()
    {
        return $this->hasOne(City::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function storeUnionTable($request)
    {
        if ($request->city_id) {
            $table = DB::table('union_actions');

            $table->whereActionId($this->id)->delete();

            foreach ($request->city_id as $id) {
                $table->insert(['action_id' => $this->id, 'city_id' => $id]);
            }
        }
    }

    public function getUnionTable()
    {
        $table = DB::table('union_actions');

        $query = $table->leftJoin('cities', 'cities.id', '=', 'union_actions.city_id')
                       ->leftJoin('regions', 'regions.id', '=', 'cities.region_id')
                       ->whereActionId($this->id)
                       ->get(['cities.id', 'cities.title_ru', 'regions.id as region_id']);

        return $query;
    }

}
