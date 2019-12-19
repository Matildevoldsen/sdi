<?php

namespace App\Console\Commands;

use App\Category;
use App\Post;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SiteMapGenerate extends Command
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
    protected $description = 'Command description';

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
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/om-mig'));

        Category::all()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(Url::create("/katogori/vis//{$category->id}"));
        });

        Post::all()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(Url::create("/artikel/{$post->id}/s-{$post->slug}"));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

    }
}
