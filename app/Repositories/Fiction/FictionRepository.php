<?php

namespace App\Repositories\Fiction;

use App\Services\Fiction\FictionServiceInterface;
use App\Websites\WebsiteManager;

class FictionRepository implements FictionRepositoryInterface
{
    protected $fictionService;
    protected $website;

    

    public function getFiction($id, $includes = [])
    {
        $this->fictionService = app(FictionServiceInterface::class);
        return $this->fictionService->getFiction($id, $includes);
    }
    
    public function getFictionChapters($fictionId, $html)
    {
        return $this->fictionService->getFictionChapters($fictionId, $html);
    }

    public function getFictionChapter($fictionId, $chapterId, $html)
    {
        return $this->fictionService->getFictionChapter($fictionId, $chapterId, $html);
    }
    
}
