<?php

namespace App\Parsers\RoyalRoad;

use App\Parsers\ParserInterface;
use DateTime;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlWeb;

class AuthorParser implements ParserInterface
{
    protected $htmlWeb;
    public $html;

    public function __construct(HtmlWeb $htmlWeb)
    {
        $this->htmlWeb = $htmlWeb;
    }

    public function parse($profileId): array
    {
        $url = "https://www.royalroad.com/profile/{$profileId}";
        $this->html = $this->htmlWeb->load($url);
        return [
            'username' => $this->getUsername($this->html),
            'joinedDate' => $this->getJoinedDate($this->html),
        ];
    }

    protected function getUsername(HtmlDocument $html): string
    {
        return trim($html->find('.username h1', 0)->text());
    }

    protected function getJoinedDate(HtmlDocument $html): DateTime
    {
        $datetimeString = $html->find('time', 0)->getAttribute('datetime');
        return new \DateTime($datetimeString);
    }

}
