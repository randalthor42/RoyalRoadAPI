<?php

namespace App\Services\Fiction;

interface FictionServiceInterface
{
    public function getFiction($id, $includes = []);

    public function getFictionChapters($fictionId, $html);

    public function getFictionChapter($fictionId, $chapterId, $html);


}
