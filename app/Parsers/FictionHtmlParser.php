<?php
namespace App\Parsers;

use simplehtmldom\HtmlDocument;

class FictionHtmlParser
{
    /**
     *  Extract title from the HTML document
     * 
     * @param HtmlDocument $html
     * @return string
     */
    public static function getTitle(HtmlDocument $html): string
    {
        $title = $html->find('h1', 0)->text();
        return trim(preg_replace('/\s+/', ' ', $title));
    }

    /**
     *  Extract the novel tags from the HTML document
     * 
     * @param HtmlDocument $html
     * @return array
     */
    public static function getTags(HtmlDocument $html): array
    {
        $tags = [];
        foreach ($html->find('.tags a') as $node) {
            $tags[] = $node->innertext;
        }
        return $tags;
    }
    /**
     *  Extract the warnings tags from the HTML document
     * 
     * @param HtmlDocument $html
     * @return array
     */
    public static function getWarnings(HtmlDocument $html): array
    {
        $warningDetails = $html->find('.fiction-info div.text-center.font-red-sunglo strong:contains("Warning") ~ ul.list-inline li');
        $warnings = [];
        foreach ($warningDetails as $detail) {
            $warnings[] = $detail->text();
        }
        return $warnings;
    }
    
    /**
     *  Extract description from the HTML document
     * 
     * @param HtmlDocument $html
     * @return string
     */
    public static function getDescription(HtmlDocument $html): string
    {
        $description = $html->find('.description', 0);
        return $description->text();
    }
     /**
     * Extract cover image URL from the HTML document
     * 
     * @param HtmlDocument $html
     * @return string
     */
    public static function getCover(HtmlDocument $html): ?string
    {
        return $html->find('.cover-art-container img', 0)->src;
    }
}
