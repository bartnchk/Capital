<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Статические страницы
     *
     * для посева данных используйте комманду  php artisan db:seed --class=MainPageSeeder
     *
     * @return void
     */
    public function run()
    {
        /*раздел вы получаете*/

        DB::table('main_youget')->insert([
            'title_ru' => 'Качество',
            'title_uk' => 'Якість',
            'description_ru' => 'ломбард обязан предспавить вам документы, подтверждающие
квалификацию оценщика',
            'description_uk' => 'ломбард зобов\'язаний предспавіть вам документи, що підтверджують
кваліфікацію оцінювача'
        ]);
        DB::table('main_youget')->insert([
            'title_ru' => 'Анонимность',
            'title_uk' => 'Анонімність',
            'description_ru' => 'наш ломбард уважает право клиента, и сделка проведится тактично и анонимно',
            'description_uk' => 'наш ломбард поважає право клієнта, і угода проведена тактовно і анонімно'
        ]);
        DB::table('main_youget')->insert([
            'title_ru' => 'Безопасность',
            'title_uk' => 'Безпеку',
            'description_ru' => 'поскольку мы принимаем дорогие вещи, безопасность их хранения на высшем уровне',
            'description_uk' => 'оскільки ми приймаємо дорогі речі, безпеку їх зберігання на вищому рівні'
        ]);
        DB::table('main_youget')->insert([
            'title_ru' => 'Скорость',
            'title_uk' => 'Швидкість',
            'description_ru' => 'мы можем предоставить деньги в день обращения - узнайте какая максимальная сумма',
            'description_uk' => 'ми можемо надати гроші в день звернення - дізнайтеся яка максимальна сума'
        ]);

        /*раздел под залог*/

        DB::table('main_bail')->insert([
            'title_ru' => 'Золото',
            'title_uk' => 'Золото',
            'description_ru' => 'Оценочная стоимость залога зависит в первую очередь от пробы металла и состояния изделия',
            'description_uk' => 'Оціночна вартість застави залежить в першу чергу від проби металу і стану вироби'
        ]);
        DB::table('main_bail')->insert([
            'title_ru' => 'Техника',
            'title_uk' => 'Техніка',
            'description_ru' => 'Кредит под залог электронной, бытовой, кухонной, крупной и мелкой техники',
            'description_uk' => 'Кредит під заставу електронної, побутової, кухонної, великої і дрібної техніки'
        ]);
        DB::table('main_bail')->insert([
            'title_ru' => 'Серебро',
            'title_uk' => 'Срібло',
            'description_ru' => 'Оценочная стоимость залога зависит в первую очередь от пробы металла и состояния изделия',
            'description_uk' => 'Оціночна вартість застави залежить в першу чергу від проби металу і стану вироби'
        ]);

        /*раздел специальные возможности*/

        DB::table('main_abilities')->insert([
            'title_ru' => 'Бриллианты',
            'title_uk' => 'Діаманти',
            'description_ru' => 'Оценочная стоимость залога зависит в первую очередь от пробы металла и состояния изделия',
            'description_uk' => 'Оціночна вартість застави залежить в першу чергу від проби металу і стану виробу'
        ]);
        DB::table('main_abilities')->insert([
            'title_ru' => 'Антиквариат',
            'title_uk' => 'Антикваріат',
            'description_ru' => 'Оценочная стоимость залога зависит в первую очередь от пробы металла и состояния изделия',
            'description_uk' => 'Оціночна вартість застави залежить в першу чергу від проби металу і стану виробу'
        ]);
        DB::table('main_abilities')->insert([
            'title_ru' => 'Часы',
            'title_uk' => 'Годинники',
            'description_ru' => 'Оценочная стоимость залога зависит в первую очередь от пробы металла и состояния изделия',
            'description_uk' => 'Оціночна вартість застави залежить в першу чергу від проби металу і стану виробу'
        ]);
        DB::table('main_abilities')->insert([
            'title_ru' => 'Драгоценности',
            'title_uk' => 'Коштовності',
            'description_ru' => 'Оценочная стоимость залога зависит в первую очередь от пробы металла и состояния изделия',
            'description_uk' => 'Оціночна вартість застави залежить в першу чергу від проби металу і стану виробу'
        ]);

        /*Достижения (счетчики)*/
        DB::table('achievements')->insert([
            'years' => 13,
            'offices' => 406,
            'cities' => 100,
            'clients' => 1809523,
            'credits' => 2943587
        ]);

        /*Настройки*/
        DB::table('settings')->insert([
            'email' => 'hotline@lombard.credit',
            'phone' => '0 800 300 703',
            'viber' => '0 800 300 703',
            'instagram' => 'https://www.instagram.com/?hl=en',
            'facebook' => 'https://www.facebook.com/lombard.capital',
            'youtube' => 'https://www.youtube.com/'
        ]);

        /*Настройки*/
        DB::table('banners')->insert([
            'title_ru' => 'Антиквариат',
            'title_uk' => 'Антикваріат',
            'description_ru' => 'Оценочная стоимость залога зависит в первую очередь от пробы металла и состояния изделия',
            'description_uk' => 'Оціночна вартість застави залежить в першу чергу від проби металу і стану виробу',
            'image' => '',
            'link' => ''
        ]);
    }
}