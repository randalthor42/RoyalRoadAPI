<?php

namespace App\Providers;

use App\Services\Chapter\ChapterService;
use App\Services\Chapter\ChapterServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\Fiction\FictionServiceInterface;
use App\Services\Fiction\FictionService;

use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FictionServiceInterface::class, FictionService::class);
        $this->app->bind(ChapterServiceInterface::class, ChapterService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }
}
