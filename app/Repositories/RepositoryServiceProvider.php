<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Novel\NovelRepositoryInterface;
use App\Repositories\Novel\NovelRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(NovelRepositoryInterface::class, NovelRepository::class);
    }
}
