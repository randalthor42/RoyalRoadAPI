<?php
namespace App\Parsers\RoyalRoad;

use App\Parsers\ParserInterface;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlWeb;

class FictionParser implements ParserInterface
{
    protected $htmlWeb;
    public $html;

    public function __construct(HtmlWeb $htmlWeb)
    {
        $this->htmlWeb = $htmlWeb;
    }

    public function parse($id): array
    {
        $url = "https://www.royalroad.com/fiction/{$id}";
        $this->html = $this->htmlWeb->load($url);

        return [
            'id' => $id,
            'title' => $this->getTitle($this->html),
            'tags' => $this->getTags($this->html),
            'warnings' => $this->getWarnings($this->html),
            'description' => $this->getDescription($this->html),
            'cover' => $this->getCover($this->html),
        ];
    }

    public function getHtml()
    {
        return $this->html;
    }

    /**
     *  Extract title from the HTML document
     * 
     * @param HtmlDocument $html
     * @return string
     */
    protected function getTitle(HtmlDocument $html): string
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
    protected function getTags(HtmlDocument $html): array
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
    protected function getWarnings(HtmlDocument $html): array
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
    protected function getDescription(HtmlDocument $html): string
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
    protected function getCover(HtmlDocument $html): ?string
    {
        return $html->find('.cover-art-container img', 0)->src;
    }
}
