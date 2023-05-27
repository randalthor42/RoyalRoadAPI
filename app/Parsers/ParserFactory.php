<?php
namespace App\Parsers;

class ParserFactory
{
    public function make(string $parserClass): ParserInterface
    {
        return app($parserClass);
    }
}
