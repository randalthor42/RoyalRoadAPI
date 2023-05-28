<?php
namespace App\Http\Middleware;

use App\Websites\WebsiteContext;
use App\Parsers\ParserRegistry;
use Closure;
use Illuminate\Http\Request;
use App\Websites\WebsiteManager;

class SetWebsiteForWebsiteContext
{
    protected $websiteContext;

    public function __construct(WebsiteContext $websiteContext)
    {
        $this->websiteContext = $websiteContext;
    }

    public function handle(Request $request, Closure $next)
    {
        $website = $request->route('website');
        $websiteManager = new WebsiteManager();
        $website = $websiteManager->getWebsite($website);

        app()->singleton(WebsiteContext::class, function ($app) use ($website) {
            $this->websiteContext->setWebsite($website);
            return $this->websiteContext;
        });

        // Fetch the parserRegistry and set the current website
        if (app()->bound(ParserRegistry::class)) {
            $parserRegistry = app(ParserRegistry::class);
            $parserRegistry->setCurrentWebsite($website);
        }

        return $next($request);
    }
}
