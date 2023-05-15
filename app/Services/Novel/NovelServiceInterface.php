<?php

namespace App\Services\Novel;

interface NovelServiceInterface
{
    public function getNovel($id, $includes = []);
}
