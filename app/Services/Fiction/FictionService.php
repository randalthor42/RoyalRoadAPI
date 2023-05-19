<?php

namespace App\Services\Fiction;

use App\DTOs\FictionDto;
use App\Services\Chapter\ChapterServiceInterface;
use simplehtmldom\HtmlDocument;
use App\Handlers\FictionIncludeHandler;

class FictionService implements FictionServiceInterface
{
    /** @var FictionSourceInterface */
    protected $fictionSource;

    /** @var ChapterServiceInterface */
    protected $chapterService;
    /**
     * FictionService constructor.
     *
     * @param FictionSourceInterface $fictionSource
     * @param ChapterServiceInterface $chapterService
     * @param AuthorServiceInterface $authorService
     */
    public function __construct(FictionSourceInterface $fictionSource ,ChapterServiceInterface $chapterService)
    {
        $this->fictionSource = $fictionSource;
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

        $html = $this->fictionSource->loadFiction($id);
        $details = $this->fictionSource->getFictionDetails($id, $html);
        $includes = $this->getIncludes($id, $html, $includes);
    
        return new FictionDto($details['id'], $details['title'], $details['tags'], $details['warnings'], $details['description'], $details['cover'], $includes);
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
