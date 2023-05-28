<?php
namespace Tests\Unit;

use App\Parsers\ParserFactory;
use App\Parsers\RoyalRoad\FictionParser;
use Tests\TestCase;

class ParserFactoryTest extends TestCase
{
    public function test_make_parser()
    {
        $parserFactory = new ParserFactory();
        $parser = $parserFactory->make(FictionParser::class);
        $this->assertInstanceOf(FictionParser::class, $parser);
    }
}
