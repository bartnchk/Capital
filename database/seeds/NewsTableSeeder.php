<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            \Illuminate\Support\Facades\DB::table('news')->truncate();
            factory(App\Models\Admin\News::class, 50)->create();
        }
    }
}
