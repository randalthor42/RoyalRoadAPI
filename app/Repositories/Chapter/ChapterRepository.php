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

    public function getChapters($novelId, $html = null)
    {
        return $this->chapterService->getChapters($novelId, $html);
    }
    
    public function getChapter($novelId, $chapterId, $html = null)
    {
        return $this->chapterService->getChapter($novelId, $chapterId, $html);
    }
}
