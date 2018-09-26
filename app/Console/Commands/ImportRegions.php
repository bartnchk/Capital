<?php

namespace App\Console\Commands;

use App\Models\Admin\Region;
use App\Models\Common\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportRegions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:regions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт городов';

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
        $this->info('Надеюсь это не займет много времени...');

        foreach (DB::table('wp_term_taxonomy')->where([
            ['taxonomy', '=', 'regions_cities'],
            ['parent', '=', 0]
        ])->cursor() as $old_region){
            $region = DB::table('wp_terms')->where('term_id', $old_region->term_id)->first();
            Region::create([
                'id' => $region->term_id,
                'title_ru' => $region->name,
                'title_uk' => $region->name,
                'published' => 1
            ]);
        }
        $this->info('Области есть, теперь города...');

        foreach (DB::table('wp_term_taxonomy')->where([
            ['taxonomy', '=', 'regions_cities'],
            ['parent', '!=', 0]
        ])->cursor() as $old_city){
            $city = DB::table('wp_terms')->where('term_id', $old_city->term_id)->first();
            City::create([
                'id' => $city->term_id,
                'title_ru' => $city->name,
                'title_uk' => $city->name,
                'region_id' => $old_city->parent,
                'published' => 1
            ]);
        }
        $this->info('Готово!!!');
    }
}
