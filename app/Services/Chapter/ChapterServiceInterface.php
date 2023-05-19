<?php

namespace App\Services\Chapter;

interface ChapterServiceInterface
{
    public function getChapters($novelId, $html = null);
    
    public function getChapter($novelId, $chapterId, $html = null);
}
