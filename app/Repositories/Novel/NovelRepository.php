<?php

namespace App\Repositories\Novel;

use App\Services\Novel\NovelServiceInterface;

class NovelRepository implements NovelRepositoryInterface
{
    protected $novelService;

    public function __construct(NovelServiceInterface $novelService)
    {
        $this->novelService = $novelService;
    }

    public function getNovel($id)
    {
        return $this->novelService->getNovel($id);
    }
}
