<?php

namespace App\Handlers;

use App\Services\Fiction\FictionService;
use simplehtmldom\HtmlDocument;

class FictionIncludeHandler
{
    private $fictionService;

    public function __construct(FictionService $fictionService)
    {
        $this->fictionService = $fictionService;
    }
    public function handle(string $id, HtmlDocument $html, array $includes): array
    {
        $results = [];
    
        foreach ($includes as $include) {
            $includeParts = explode(':', $include);
            $includeType = $includeParts[0];
            $includeValue = $includeParts[1] ?? null;
    
            switch ($includeType) {
                case 'chapters':
                    if ($includeValue) {
                        $results['chapter'] = $this->fictionService->getFictionChapter($id, $includeValue, $html);
                    } else {
                        $results['chapters'] = $this->fictionService->getFictionChapters($id, $html);
                    }
                    break;
                default:
                    break;
            }
        }
    
        return $results;
    }
    
}
