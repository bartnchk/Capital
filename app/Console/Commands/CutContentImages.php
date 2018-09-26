<?php

namespace App\Console\Commands;

use App\Models\Admin\News;
use Illuminate\Console\Command;

class CutContentImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cut:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаляет wysiwyg картинки из контента';

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
        $this->info('Поехали...');
        foreach (News::cursor() as $news){

            $news->description_ru = preg_replace('/<img(?:\\s[^<>]*)?>/i', '', $news->description_ru);
            $news->description_uk = preg_replace('/<img(?:\\s[^<>]*)?>/i', '', $news->description_uk);

            $news->save();
        }
        $this->info('Проверьте новости, должно было получиться.');
    }
}
