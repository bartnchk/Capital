<?php

namespace App\Console\Commands;

use App\Models\Admin\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'импорт новостей';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Процесс может занять какое-то время, пойди лучше сделай кофе или чай...');
        function get_string_between($string, $start, $end){
            $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
        }

        foreach (DB::table('wp_posts')->where('post_type', '=', 'news_special_offer')->cursor() as $old_news){

            $news = new News;
            $input = [];
            // get titles
            if (preg_match("[:ru]", $old_news->post_title) and preg_match("[:ua]", $old_news->post_title)){
                $input['title_ru'] = get_string_between($old_news->post_title, '[:ru]', '[:ua]');
                $input['title_uk'] = get_string_between($old_news->post_title, '[:ua]', '[:]');
            } elseif (preg_match("[:ru]", $old_news->post_title) and !preg_match("[:ua]", $old_news->post_title)){
                $input['title_ru'] = get_string_between($old_news->post_title, '[:ru]', '[:]');
                $input['title_uk'] = $input['title_ru'];
            } elseif (!preg_match("[:ru]", $old_news->post_title) and preg_match("[:ua]", $old_news->post_title)){
                $input['title_uk'] = get_string_between($old_news->post_title, '[:ua]', '[:]');
                $input['title_ru'] = $input['title_uk'];
            } else {
                $input['title_ru'] = $old_news->post_title;
                $input['title_uk'] = $old_news->post_title;
            }
            // get descriptions
            if (!$old_news->post_content){
                $input['description_ru'] = 'Нет контента';
                $input['description_uk'] = 'Нет контента';
            } else {
                if (preg_match("[:ru]", $old_news->post_content) and preg_match("[:ua]", $old_news->post_content)){
                    $input['description_ru'] = get_string_between($old_news->post_content, '[:ru]', '[:ua]');
                    $input['description_uk'] = get_string_between($old_news->post_content, '[:ua]', '[:]');
                } elseif (preg_match("[:ru]", $old_news->post_content) and !preg_match("[:ua]", $old_news->post_content)){
                    $input['description_ru'] = get_string_between($old_news->post_content, '[:ru]', '[:]');
                    $input['description_uk'] = $input['description_ru'];
                } elseif (!preg_match("[:ru]", $old_news->post_content) and preg_match("[:ua]", $old_news->post_content)){
                    $input['description_uk'] = get_string_between($old_news->post_content, '[:ua]', '[:]');
                    $input['description_ru'] = $input['description_uk'];
                } else {
                    $input['description_ru'] = $old_news->post_content;
                    $input['description_uk'] = $old_news->post_content;
                }
            }
            $input['alias'] = $old_news->post_name;
            $input['created_at'] = $old_news->post_date;
            $input['updated_at'] = $old_news->post_modified;
            $input['type'] = 'news';
            $input['meta_title_ru'] = $input['title_ru'];
            $input['meta_title_uk'] = $input['title_uk'];
            $input['meta_description_ru'] = $input['title_ru'];
            $input['meta_description_uk'] = $input['title_uk'];

            // получаем изображение новости  в виде полного url
            $old_image = DB::table('wp_posts')->select('guid')
                ->where('post_parent', '=', $old_news->ID)
                ->where(function($q) {
                    $q->where('post_mime_type', '=', 'image/jpeg')
                        ->orWhere('post_mime_type',  '=', 'image/png');
                })
                ->first();
            if ($old_image){
                    // обрезаем домен
                    $old_image = substr($old_image->guid,40);
                    // записываем на диск
                    $new_image = $news->saveFromPathWithThumbnail($old_image, 'news', 650, 500, 418, 243);

                    $input['image'] = $new_image;
                }

            $news->fill($input);
            $news->save();
        }
        $this->info('Готово!!!');
    }
}
