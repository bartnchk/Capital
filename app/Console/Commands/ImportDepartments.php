<?php

namespace App\Console\Commands;

use App\Models\Common\Office;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportDepartments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:departments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт отделений';

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

        foreach (DB::table('wp_posts')->where('post_type', '=', 'department')->cursor() as $department){

        $office = new Office;

        /**        Получаем номер отделения       */

         $input['number'] = (int)substr(preg_replace('/[^0-9]/', '', $department->post_title), 0, 3);

        /**        Получаем адрес       */

        $address = DB::table('wp_postmeta')->where('post_id', '=', $department->ID)->where('meta_key', 'address_text')->first();

        if (preg_match("<!--:ru-->", $address->meta_value) and preg_match("<!--:ua-->", $address->meta_value)) {
            $input['address_ru'] = get_string_between($address->meta_value, '<!--:ru-->', '<!--:-->');
            $input['address_uk'] = get_string_between($address->meta_value, '<!--:ua-->', '<!--:-->');
        } else {
            $input['address_ru'] = $address->meta_value;
            $input['address_uk'] = $address->meta_value;
        }

        /**        Получаем телефон      */

        $phone = DB::table('wp_postmeta')->where('post_id', '=', $department->ID)->where('meta_key', 'telephone')->first();
        if (preg_match("<!--:ru-->", $phone->meta_value)) {
            $input['phone'] = get_string_between($phone->meta_value, '<!--:ru-->', '<!--:-->');
        } else {
            $input['phone'] = $phone->meta_value;
        }

        /**        Получаем время работы     */

        $work_time = DB::table('wp_postmeta')->where('post_id', '=', $department->ID)->where('meta_key', 'work_time')->first();

        if (preg_match("<!--:ru-->", $work_time->meta_value) and preg_match("<!--:ua-->", $work_time->meta_value)) {
            $input['work_days_ru'] = get_string_between($work_time->meta_value, '<!--:ru-->', '<!--:-->');
            $input['work_days_uk'] = get_string_between($work_time->meta_value, '<!--:ua-->', '<!--:-->');
        } else {
            $input['work_days_ru'] = $work_time->meta_value;
            $input['work_days_uk'] = $work_time->meta_value;
        }

        /**        Получаем координаты    */

        $coordinates = DB::table('wp_postmeta')->where('post_id', '=', $department->ID)->where('meta_key', 'map')->first();

        $coordinates = unserialize($coordinates->meta_value);
        $input['lat'] = $coordinates['lat'];
        $input['lng'] = $coordinates['lng'];

        /**        Получаем картинку    */

        $old_image = DB::table('wp_posts')->select('guid')
            ->where('post_parent', '=', $department->ID)
            ->where(function($q) {
                $q->where('post_mime_type', '=', 'image/jpeg')
                    ->orWhere('post_mime_type',  '=', 'image/png');
            })
            ->first();

        if ($old_image){
            // обрезаем домен
            $old_image = substr($old_image->guid,40);
            // записываем на диск
//            $input['image'] = $old_image;
            $input['image'] = $office->saveImageFromPath($old_image, 'offices', 300, 254);
        }

        /**        Получаем регион и город  */

        $region_cities = DB::table('wp_term_relationships')->where('object_id', '=', $department->ID)->pluck('term_taxonomy_id')->all();

        $region =DB::table('wp_term_taxonomy')
            ->whereIN('term_taxonomy_id', $region_cities)
            ->where('taxonomy', '=', 'regions_cities')
            ->where('parent', '=', 0)
            ->first();
        $city =DB::table('wp_term_taxonomy')
            ->whereIN('term_taxonomy_id', $region_cities)
            ->where('taxonomy', '=', 'regions_cities')
            ->where('parent', '!=', 0)
            ->first();
        if ($region){
            $input['region_id'] = $region->term_taxonomy_id;
        }
        if ($city){
            $input['city_id'] = $city->term_taxonomy_id;
        }

        $input['meta_title_ru'] = 'Отделение №'.$input['number'];
        $input['meta_title_uk'] = 'Відділення №'.$input['number'];

        $office->fill($input);
        $office->save();


        }
        $this->info('Готово!!!');
    }
}
