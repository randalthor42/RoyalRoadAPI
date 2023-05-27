<?php
namespace App\Parsers\RoyalRoad;

use App\Parsers\ParserInterface;
use Exception;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlWeb;

class ChapterParser implements ParserInterface
{
    protected $htmlWeb;

    public function __construct(HtmlWeb $htmlWeb)
    {
        $this->htmlWeb = $htmlWeb;
    }

    public function parse($novelId, $html = null): array
    {
        if ($html === null) {
            $url = "https://www.royalroad.com/fiction/{$novelId}";
            $html = $this->htmlWeb->load($url);
        }
        return $this->getChapters($html);
    }

    public static function getChapters(HtmlDocument $html): array
    {
        // Find all script tags
        $scriptTags = $html->find('script');

        // Find the script tag that contains 'window.chapters'
        $script = null;
        foreach ($scriptTags as $scriptTag) {
            if (strpos($scriptTag->innertext, 'window.chapters') !== false) {
                $script = $scriptTag;
                break;
            }
        }

        // Ensure script tag was found
        if ($script === null) {
            throw new Exception("Unable to find chapters data in script tags.");
        }

        // Extract and decode the chapters data
        preg_match('/window\.chapters = (\[.*?\]);/', $script->innertext, $matches);
        $chaptersJson = $matches[1] ?? '';
        $chapters = json_decode($chaptersJson, true);

        return $chapters;
    }

    /**
     * Extract chapter title from the HTML document
     *
     * @param HtmlDocument $html
     * @return string
     */
    public static function getTitle(HtmlDocument $html): string
    {
        $title = $html->find('h1', 0)->text();
        return trim(preg_replace('/\s+/', ' ', $title));
    }

   
    public static function getContent(HtmlDocument $html): string
    {
        $content = $html->find('.chapter-inner.chapter-content', 0)->text();
        return trim($content);
    }
}
