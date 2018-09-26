<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Admin\News::class, function (Faker $faker) {
    $title = $faker->sentence;
    $slug = str_slug($title);
    return [
        'title_ru' => $title,
        'title_uk' => $title,
        'description_ru' => $faker->paragraph,
        'description_uk' => $faker->paragraph,
        'alias' => $slug,
        'published' => 1
    ];
});
