<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\SitemapController;

class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate and warm up XML Sitemaps cache for Rootera Plumbing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Flushing old sitemap cache...');
        Cache::forget('sitemap_index_xml_v4');
        Cache::forget('sitemap_pages_xml_v4');
        Cache::forget('sitemap_services_xml_v4');
        Cache::forget('sitemap_cities_xml_v4');
        Cache::forget('sitemap_blog_xml_v4');
        Cache::forget('sitemap_gallery_xml_v4');
        Cache::forget('sitemap_videos_xml_v4');

        $this->info('Warming up fresh XML sitemaps...');
        $controller = new SitemapController();
        $controller->index();
        $controller->pages();
        $controller->services();
        $controller->cities();
        $controller->blog();
        $controller->gallery();
        $controller->videos();

        $this->info('Sitemap successfully regenerated and cached!');
        return Command::SUCCESS;
    }
}
