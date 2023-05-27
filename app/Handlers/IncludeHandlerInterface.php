<?php

namespace App\Handlers;

use simplehtmldom\HtmlDocument;

interface IncludeHandlerInterface
{
    public function handle(string $id, HtmlDocument $html, array $includes): array;
}
