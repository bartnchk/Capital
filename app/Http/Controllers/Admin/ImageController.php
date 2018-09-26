<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();

        if (request()->expectsJson()){
            return response([
                "class" => "success", "message" => 'Изображение удалено.'
            ]);
        } else {
            return response([
                "class" => "error", "message" => 'При удалении картинки произошла ошибка'
            ]);
        }
    }
}
