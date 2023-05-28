<?php

namespace App\Providers;

use App\Parsers\ParserRegistry;
use App\Parsers\ParserFactory;
use Illuminate\Support\ServiceProvider;

class ParserRegistryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ParserRegistry::class, function ($app) {
            $parserFactory = $app->make(ParserFactory::class);
            $parserRegistry = new ParserRegistry($parserFactory, null);  // passing null as no website available yet

            return $parserRegistry;
        });
    }
}
