<?php

namespace App\Services\Fiction;

use App\DTOs\FictionDto;
use App\Services\Chapter\ChapterServiceInterface;
use simplehtmldom\HtmlDocument;
use App\Handlers\FictionIncludeHandler;
use App\Parsers\ParserRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FictionService implements FictionServiceInterface
{
    /** @var ParserRegistry */
    protected $parserRegistry;

    /** @var ChapterServiceInterface */
    protected $chapterService;

    /**
     * FictionService constructor.
     *
     * @param ParserRegistry $parserRegistry
     * @param ChapterServiceInterface $chapterService
     */
    public function __construct(ParserRegistry $parserRegistry, ChapterServiceInterface $chapterService)
    {
        $this->parserRegistry = $parserRegistry;
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
        $fictionParser = $this->parserRegistry->getParser('fiction');
        $details = $fictionParser->parse($id);
        $includes = $this->getIncludes($id, $fictionParser->getHtml(), $includes);
    
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
      
        $includeHandler = new FictionIncludeHandler($this, $this->parserRegistry);    
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