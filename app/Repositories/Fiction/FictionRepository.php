<?php

namespace App\Repositories\Fiction;

use App\Services\Fiction\FictionServiceInterface;

class FictionRepository implements FictionRepositoryInterface
{
    protected $fictionService;

    public function __construct(FictionServiceInterface $fictionService)
    {
        $this->fictionService = $fictionService;
    }

    public function getFiction($id, $includes = [])
    {
        return $this->fictionService->getFiction($id, $includes);
    }
}
