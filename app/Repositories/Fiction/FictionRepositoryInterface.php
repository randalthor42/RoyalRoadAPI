<?php

namespace App\Repositories\Fiction;

interface FictionRepositoryInterface
{
    public function getFiction($id, $includes = []);

    public function getFictionChapters($fictionId, $html);

    public function getFictionChapter($fictionId, $chapterId, $html);

}
