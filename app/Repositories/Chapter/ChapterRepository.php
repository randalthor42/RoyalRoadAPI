<?php

namespace App\Repositories\Chapter;

use App\Repositories\Chapter\ChapterRepositoryInterface;
use App\Services\Chapter\ChapterServiceInterface;

class ChapterRepository implements ChapterRepositoryInterface
{
    protected $chapterService;
    
    public function __construct(ChapterServiceInterface $chapterService)
    {
        $this->chapterService = $chapterService;    
    }

    public function getChapters($fictionId, $html = null)
    {
        return $this->chapterService->getChapters($fictionId, $html);
    }
    
    public function getChapter($fictionId, $chapterId, $html = null)
    {
        return $this->chapterService->getChapter($fictionId, $chapterId, $html);
    }
}
