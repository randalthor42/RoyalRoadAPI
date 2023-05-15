<?php

namespace App\Transformers;

class NovelTransformer
{
    public function transform($novel)
    {
        return [
            'id' => $novel['id'],
            'title' => $novel['title'],
            'author' => [
                'name' => $novel['author'],
                'link' => $novel['author_link'],
            ],
            'tags' => $novel['tags'],
            'description' => $novel['description'],
        ];
    }
}