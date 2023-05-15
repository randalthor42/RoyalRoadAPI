<?php

namespace App\Providers;

use App\Services\Chapter\ChapterService;
use App\Services\Chapter\ChapterServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\Novel\NovelServiceInterface;
use App\Services\Novel\NovelService;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(NovelServiceInterface::class, NovelService::class);
        $this->app->bind(ChapterServiceInterface::class, ChapterService::class);
    }
}
