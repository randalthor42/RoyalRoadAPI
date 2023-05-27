<?php
return [
    'royalroad' => [
        'url_pattern' => 'royalroad.com',
        'parsers' => [
            'fiction' => \App\Parsers\RoyalRoad\FictionParser::class,
            'chapters' => \App\Parsers\RoyalRoad\ChapterParser::class,
            'chapterContent' => \App\Parsers\RoyalRoad\ChapterContentParser::class,
        ],
    ],
];