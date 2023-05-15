<?php

namespace App\Transformers;

class ChapterTransformer
{
    public function transform($chapters)
    {
        return array_map(function ($chapter) {
            return [
                'id' => $chapter['id'],
                'volumeId' => $chapter['volumeId'],
                'title' => $chapter['title'],
                'date' => $chapter['date'],
                'url' => $chapter['url'],
                //'slug' => $chapter['slug'],
            ];
        }, $chapters);
    }
}