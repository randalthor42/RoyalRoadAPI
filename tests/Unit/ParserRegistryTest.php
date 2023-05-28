<?php
namespace Tests\Unit;

use App\Parsers\ParserFactory;
use App\Parsers\ParserRegistry;
use App\Parsers\RoyalRoad\FictionParser;
use App\Websites\WebsiteManager;
use Tests\TestCase;

class ParserRegistryTest extends TestCase
{
    public function test_get_parser()
    {
        $websiteManager = new WebsiteManager();
        $parserFactory = new ParserFactory();
        $parserRegistry = new ParserRegistry($parserFactory, $websiteManager->getWebsite('royalroad'));
        $parser = $parserRegistry->getParser('fiction');
        $this->assertInstanceOf(FictionParser::class, $parser);
    }
}
