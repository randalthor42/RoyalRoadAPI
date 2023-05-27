<?php

namespace App\Handlers;

use App\Parsers\ParserRegistry;
use App\Services\Fiction\FictionService;
use simplehtmldom\HtmlDocument;

class FictionIncludeHandler implements IncludeHandlerInterface
{
    private $fictionService;
    private $parserRegistry;

    public function __construct(FictionService $fictionService, ParserRegistry $parserRegistry)
    {
        $this->fictionService = $fictionService;
        $this->parserRegistry = $parserRegistry;
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
                    if ($includeValue != null) {
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
