<?php

namespace App\Repositories\Chapter;

interface ChapterRepositoryInterface
{
    public function getChapters($novelId, $html = null);
    
    public function getChapter($novelId, $chapterId, $html = null);
}
