<?php

namespace App\Providers;

use App\Repositories\Chapter\ChapterRepository;
use App\Repositories\Chapter\ChapterRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Fiction\FictionRepositoryInterface;
use App\Repositories\Fiction\FictionRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FictionRepositoryInterface::class, FictionRepository::class);
        $this->app->bind(ChapterRepositoryInterface::class, ChapterRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
