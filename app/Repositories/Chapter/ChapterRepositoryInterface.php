<?php

namespace App\Repositories\Chapter;

interface ChapterRepositoryInterface
{
    public function getChapters($novelId, $html = null);
}
