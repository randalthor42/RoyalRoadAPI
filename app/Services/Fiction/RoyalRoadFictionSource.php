<?php

namespace App\Services\Fiction;

use simplehtmldom\HtmlWeb;
use simplehtmldom\HtmlDocument;
use App\Parsers\FictionHtmlParser;

class RoyalRoadFictionSource implements FictionSourceInterface
{
    /** @var HtmlWeb */
    protected $htmlWeb;

    public function __construct(HtmlWeb $htmlWeb)
    {
        $this->htmlWeb = $htmlWeb;
    }

    public function loadFiction($id): HtmlDocument
    {
        $url = "https://www.royalroad.com/fiction/{$id}";
        return $this->htmlWeb->load($url);
    }

     /**
     * Extracts novel details from the HTML document
     * 
     * @param string $id
     * @param HtmlDocument $html
     * @return array
     */
    public function getFictionDetails($id, HtmlDocument $html): array
    {
        return [
            'id' => $id,
            'title' => FictionHtmlParser::getTitle($html),
            'tags' => FictionHtmlParser::getTags($html),
            'warnings' => FictionHtmlParser::getWarnings($html),
            'description' => FictionHtmlParser::getDescription($html),
            'cover' => FictionHtmlParser::getCover($html),
        ];
    }
}
