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

    public function getChapters($novelId)
    {
        return $this->chapterService->getChapters($novelId);
    }
}
