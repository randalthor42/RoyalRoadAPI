<?php

namespace App\Services\Fiction;

use App\DTOs\FictionDto;
use App\Parsers\FictionHtmlParser;
use App\Services\Chapter\ChapterServiceInterface;
use simplehtmldom\HtmlWeb;
use simplehtmldom\HtmlDocument;
use App\Handlers\FictionIncludeHandler;
use Exception;

class FictionService implements FictionServiceInterface
{
    /** @var HtmlWeb */
    protected $htmlWeb;

    /** @var ChapterServiceInterface */
    protected $chapterService;

    /** @var AuthorServiceInterface */
    protected $authorService;

    /**
     * FictionService constructor.
     *
     * @param HtmlWeb $htmlWeb
     * @param ChapterServiceInterface $chapterService
     */
    public function __construct(HtmlWeb $htmlWeb ,ChapterServiceInterface $chapterService)
    {
        $this->htmlWeb = $htmlWeb;
        $this->chapterService = $chapterService;
    }

    /**
     * Get Fiction and its related data based on the provided id and includes.
     * 
     * @param string $id
     * @param array $includes
     * @return array
     */
    public function getFiction($id, $includes = []): FictionDto
    {
        $url = "https://www.royalroad.com/fiction/{$id}";
        $html = $this->loadUrl($url);
    
        $details = $this->getFictionDetails($id, $html);
        $includes = $this->getIncludes($id, $html, $includes);
    
        return new FictionDto($details['id'], $details['title'], $details['tags'], $details['warnings'], $details['description'], $details['cover'], $includes);
    }
    

    /**
     * Extracts novel details from the HTML document
     * 
     * @param string $id
     * @param HtmlDocument $html
     * @return array
     */
    protected function getFictionDetails($id, HtmlDocument $html)
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

    /**
     * Fetch additional data (includes) based on provided includes parameter.
     * 
     * @param string $id
     * @param HtmlDocument $html
     * @param array $includes
     * @return array
     */
    protected function getIncludes($id, HtmlDocument $html, array $includes)
    {
      
        $includeHandler = new FictionIncludeHandler($this);    
        return $includeHandler->handle($id, $html, $includes);
    }    

    /**
     * Load HTML document from a given URL
     * 
     * @param string $url
     * @return HtmlDocument
     */
    protected function loadUrl($url)
    {
        return $this->htmlWeb->load($url);
    }

    /**
     * Fetch the author details for a novel
     * 
     * @param string $id
     * @param HtmlDocument $html
     * @return array
     */
    protected function getAuthor($id, HtmlDocument $html)
    {
        if ($this->authorService === null) {
            throw new Exception("AuthorService is not set.");
        }

        return $this->authorService->getAuthor($id);
    }

    /**
     * Fetch all chapters of a fiction
     * 
     * @param string $fictionId
     * @return array
     */
    public function getFictionChapters($fictionId, $html = null)
    {
        return $this->chapterService->getChapters($fictionId);
    }

    /**
     * Fetch a specific chapter of a fiction.
     *  
     * @param string $fictionId
     * @return array
     */
    public function getFictionChapter($fictionId, $chapterId, $html = null)
    {
        return $this->chapterService->getChapter($fictionId, $chapterId);
    }
}
