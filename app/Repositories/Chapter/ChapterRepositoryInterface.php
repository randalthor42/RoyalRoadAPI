<?php

namespace App\Repositories\Chapter;

interface ChapterRepositoryInterface
{
    public function getChapters($fictionId, $html = null);
    
    public function getChapter($fictionId, $chapterId, $html = null);
}
