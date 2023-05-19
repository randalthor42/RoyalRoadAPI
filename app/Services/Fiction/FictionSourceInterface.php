<?php
namespace App\Services\Fiction;

use simplehtmldom\HtmlDocument;

interface FictionSourceInterface
{
    public function loadFiction($id): HtmlDocument;
    public function getFictionDetails($id, HtmlDocument $html): array;
}
