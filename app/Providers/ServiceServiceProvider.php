<?php

namespace App\Providers;

use App\Services\Chapter\ChapterService;
use App\Services\Chapter\ChapterServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\Fiction\FictionServiceInterface;
use App\Services\Fiction\FictionService;
use App\Services\Fiction\FictionSourceInterface;
use App\Services\Fiction\RoyalRoadFictionSource;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FictionServiceInterface::class, FictionService::class);
        $this->app->bind(FictionSourceInterface::class, RoyalRoadFictionSource::class);
        $this->app->bind(ChapterServiceInterface::class, ChapterService::class);
    }
}
