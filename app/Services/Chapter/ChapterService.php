<?php

namespace App\Services\Chapter;

use App\Services\Chapter\ChapterServiceInterface;
use App\Transformers\ChapterTransformer;
use simplehtmldom\HtmlWeb;

class ChapterService implements ChapterServiceInterface
{
    protected $htmlWeb;
    protected $chapterTransformer;

    public function __construct(HtmlWeb $htmlWeb, ChapterTransformer $chapterTransformer)
    {
        $this->htmlWeb = $htmlWeb;
        $this->chapterTransformer = $chapterTransformer;
    }
    public function getChapters($novelId)
    {
        $url = "https://www.royalroad.com/fiction/{$novelId}";

        // Load the webpage
        $html = $this->htmlWeb->load($url);

        // Find the script tag containing the chapters data
        $script = $html->find('script', 27)->innertext;

        // Extract and decode the chapters data
        preg_match('/window\.chapters = (\[.*?\]);/', $script, $matches);
        $chaptersJson = $matches[1] ?? '';
        $chapters = json_decode($chaptersJson, true);
        $chapters = $this->chapterTransformer->transform($chapters);

        return $chapters ;
    }
}
