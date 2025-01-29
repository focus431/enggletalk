<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = '產生網站的 sitemap';

    public function handle()
    {
        // 生成 sitemap
        SitemapGenerator::create('https://enggletalk.com.tw')
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap 已經成功產生！');
    }
}