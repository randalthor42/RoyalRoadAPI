<?php

namespace App\Providers;

use App\Repositories\Chapter\ChapterRepository;
use App\Repositories\Chapter\ChapterRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Novel\NovelRepositoryInterface;
use App\Repositories\Novel\NovelRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(NovelRepositoryInterface::class, NovelRepository::class);
        $this->app->bind(ChapterRepositoryInterface::class, ChapterRepository::class);
    }
}
