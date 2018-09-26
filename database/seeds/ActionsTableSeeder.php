<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 3; $i++)
        {
           $id = DB::table('actions')->insertGetId([
                'title_ru' => 'Акция 1',
                'title_uk' => 'Акция 1 укр',
                'description_ru' => 'наш ломбард уважает право клиента, и сделка проведится тактично и анонимно',
                'description_uk' => 'наш ломбард поважає право клієнта, і угода проведена тактовно і анонімно',
                'photo' => 'image.jpeg',
                'wide_photo' => 'image.jpeg',
                'alias' => 'action1',
                'start_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                'finish_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                'published' => 1,
                'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            ]);

           DB::table('union_actions')->insert([
              'action_id' => $id,
              'city_id' => $i
           ]);
        }
    }
}
