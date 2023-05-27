<?php

namespace App\Providers;

use App\Parsers\ParserRegistry;
use App\Websites\WebsiteContext;
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
        $this->app->bind(ParserRegistry::class, function ($app) {
            $parserFactory = $app->make(ParserFactory::class);
            $websiteContext = $app->make(WebsiteContext::class);
            $website = $websiteContext->getWebsite();
            
            $parserRegistry = new ParserRegistry($parserFactory, $website);

            return $parserRegistry;
        });
    }
}
