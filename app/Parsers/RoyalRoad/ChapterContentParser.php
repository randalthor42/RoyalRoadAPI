<?php
namespace App\Parsers\RoyalRoad;

use App\Parsers\ParserInterface;
use simplehtmldom\HtmlWeb;

class ChapterContentParser implements ParserInterface
{
    protected $htmlWeb;

    public function __construct(HtmlWeb $htmlWeb)
    {
        $this->htmlWeb = $htmlWeb;
    }

     /**
     * Extract chapter content from the HTML document
     *
     * @param string $url
     * @return string
     */
    public function parse($url): string
    {
        $html = $this->htmlWeb->load($url);
        $content = $html->find('.chapter-inner.chapter-content', 0)->text();
        return trim($content);
    }
}
