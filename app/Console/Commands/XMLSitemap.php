<?php

namespace App\Console\Commands;

use App\Models\Admin\Action;
use App\Models\Admin\Page;
use App\Models\Common\Client;
use App\Models\Common\Office;
use App\Models\Site\Report;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


class XMLSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SiteMap XML Generate';

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
        $this->generateData();
    }

	public function generateData()
	{
		$routeCollection = Route::getRoutes();
		$data = array();
		foreach ($routeCollection as $value) {
			if (array_search('App\Http\Controllers\Site' , $value->action ) && array_get($value->action, 'as')){
			    if (!preg_match('/(\w*\/\{\w*\}|\{\w*\})|(main+\/+[a-z]*)|(subscribers+\/+[a-z]*)|(\s)/', $value->uri )){
			        array_push($data, $value->uri);
                }
			}
		}

		$reports = Report::published()->get();

        if ($reports)
        {
            foreach ($reports as $item){
                $url = 'reports/' . $item->alias;
                array_push( $data, $url );
            }
        }

        $actions = Action::published()->get();

        if ($actions)
        {
            foreach ($actions as $item){
                $url = 'actions/' . $item->alias;
                array_push( $data, $url );
            }
        }

        $clients = Client::published()->get();

        if ($clients)
        {
            foreach ($clients as $item){
                $url = 'clients/' . $item->alias;
                array_push( $data, $url );
            }
        }

        $departments = Office::published()->get();

        if ($departments)
        {
            foreach ($departments as $item){
                $url = 'departments/department/' . $item->number;
                array_push( $data, $url );
            }
        }

        $pages = Page::all();

        if ($pages)
        {
            foreach ($pages as $item){
                $url = '' . $item->alias;
                array_push( $data, $url );
            }
        }
        $this->initFile($data);
    }

	/**
	 * @param $data
	 */
	protected function initFile($data){
		if ($data) {
			$map = "<?xml version='1.0' encoding='UTF-8'?>" . "\n";
			$map .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";


			foreach ($data as $item )
			{
				$map .= "<url>" . "\n";
					if ($item == '/') {
						$map .=  (Request::isSecure()) ? "<loc>" . 'https://' . request()->server->get('HTTP_HOST') . "</loc>" . "\n"  :  "<loc>" . 'http://' . request()->server->get('HTTP_HOST') . "</loc>" . "\n";
						$map .= "<changefreq>daily</changefreq>" . "\n";
						$map .= "<lastmod>" . date( 'Y-m-d' ) . "</lastmod>" . "\n";
						$map .= "<priority>1</priority>" . "\n";
					}else
					{
						$map .=  (Request::isSecure()) ? "<loc>" . 'https://' . request()->server->get('HTTP_HOST') . '/' . $item . "</loc>" . "\n"  :  "<loc>" . 'http://' . request()->server->get('HTTP_HOST') . '/' . $item . "</loc>" . "\n";
						$map .= "<changefreq>daily</changefreq>" . "\n";
						$map .= "<lastmod>" . date( 'Y-m-d' ) . "</lastmod>" . "\n";
						$map .= "<priority>0.5</priority>" . "\n";
					}
				$map .= "</url>" . "\n";
			}

			$map .= "</urlset>" . "\n";

			File::put( public_path() . '/sitemap.xml', $map );

			$xml = simplexml_load_file(public_path(). '/sitemap.xml');

			if ($xml->url){
				$this->info( "Sitemap XML generated is done!" );
			}
		}
	}
}
