<?php

namespace App\Services\Chapter;

use App\Parsers\ChapterHtmlParser;
use App\Parsers\ParserRegistry;
use App\Services\Chapter\ChapterServiceInterface;
use App\Transformers\ChapterTransformer;
use simplehtmldom\HtmlWeb;

class ChapterService implements ChapterServiceInterface
{
    /** @var HtmlWeb */
    protected $htmlWeb;

    /** @var ChapterTransformer */
    protected $chapterTransformer;

    /** @var ParserRegistry */
    protected $parserRegistry;

    /** @var Array */
    protected $chapters;

    public function __construct(HtmlWeb $htmlWeb, ChapterTransformer $chapterTransformer, ParserRegistry $parserRegistry)
    {
        $this->htmlWeb = $htmlWeb;
        $this->chapterTransformer = $chapterTransformer;
        $this->parserRegistry = $parserRegistry;
    }

    /**
     * Returns all chapters.
     *
     * @param string $novelId
     * @param HtmlWeb|null $html
     * @return array
     */
    public function getChapters($novelId, $html = null)
    {
        if (!isset($this->chapters)) {
            $this->chapters = $this->fetchChapters($novelId, $html);
        }
        return $this->chapterTransformer->transform($this->chapters);
    }
    
    /**
     * Returns a specific chapter.
     *
     * @param string $novelId
     * @param string $chapterId
     * @param HtmlWeb|null $html
     * @return array|null
     */
    public function getChapter($novelId, $chapterId, $html = null)
    {
        $chapters = $this->getChapters($novelId, $html);
        $chapter = $chapters[$chapterId] ?? null;
        if ($chapter) {
            $chapterUrl = "https://www.royalroad.com{$chapter['url']}";
            $chapter['content'] = $this->fetchChapterContent($chapterUrl);
        }

        return $chapter;
    }

    /**
     * Fetches and transforms the chapters data.
     *
     * @param string $novelId
     * @param HtmlWeb|null $html
     * @return array
     */
    private function fetchChapters($novelId, $html = null)
    {
        $chapterParser = $this->parserRegistry->getParser('chapters');
        return $chapterParser->parse($novelId, $html);
    }

    protected function fetchChapterContent($url)
    {
        $chapterContentParser = $this->parserRegistry->getParser('chapterContent');
        return $chapterContentParser->parse($url);
    }
    
}
