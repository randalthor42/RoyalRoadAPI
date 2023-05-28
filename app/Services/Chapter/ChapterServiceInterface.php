<?php

namespace App\Services\Chapter;

interface ChapterServiceInterface
{
    public function getChapters($fictionId, $html = null);
    
    public function getChapter($fictionId, $chapterId, $html = null);
}
