<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * to run seeder you can call - php artisan db:seed --class=SeosTableSeeder
     *
     * @return void
     */
    public function run()
    {
        DB::table('seos')->insert([
            'title' => 'Главная страница',
            'alias' => 'main',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Акции',
            'alias' => 'action',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Новости',
            'alias' => 'news',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Часто задаваемые вопросы',
            'alias' => 'faq',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Тарифы',
            'alias' => 'tariff',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Новости',
            'alias' => 'news',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Отделения',
            'alias' => 'office',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Финансовая отчетность',
            'alias' => 'report',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Отделения',
            'alias' => 'office',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Вакансии',
            'alias' => 'vacancy',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Клиентам',
            'alias' => 'client',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Страница поиска',
            'alias' => 'search',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Кредитный калькулятор',
            'alias' => 'credit-calculator',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
        DB::table('seos')->insert([
            'title' => 'Специальные возможности',
            'alias' => 'special-abilities',
            'meta_title_ru' => 'Ломбард капитал',
            'meta_title_uk' => 'Ломбард капитал',
            'meta_keywords_ru' => 'Ломбард капитал',
            'meta_keywords_uk' => 'Ломбард капитал',
            'meta_description_ru' => 'Ломбард капитал',
            'meta_description_uk' => 'Ломбард капитал'
        ]);
    }
}