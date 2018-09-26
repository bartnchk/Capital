<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use \App\Traits\Scopes;
    use \App\Traits\HandleImage;
    use \App\Traits\Imageable;

    protected $guarded = [];

    /**
     * @param $data
     * @param $request
     * @return bool
     */
    public function saveClient($data, $request)
    {
        if( isset($data['photo']) )
            $data['photo'] = $this->saveImage($data['photo'], 'client', 418, 320);

        $data['alias'] = $data['alias'] ? $data['alias'] : str_slug($data['title_ru']);

        unset($data['_method']);
        unset($data['_token']);

        if(isset($data['gallery']))
            unset($data['gallery']);

        $this->fill($data);

        $status = $this->save();

        if ($request->has('gallery'))
        {
            foreach ($request->gallery as $image)
            {
                // создали картинку, запись на диск, возвращает filename.jpeg
                $imageName = $this->saveWithThumbnail($image, 'client', 1300, 1000, 276, 212);

                // создали запись в таблице images
                $this->addImage($imageName);
            }
        }

        if($status)
            return true;
        else
            return false;
    }
}
