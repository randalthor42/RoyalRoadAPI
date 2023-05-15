<?php

namespace App\Transformers;

class NovelTransformer
{
    public function transform($novel)
    {
        return [
            'id' => $novel['id'],
            'title' => $novel['title'],
            'tags' => $novel['tags'],
            'description' => $novel['description'],
            'cover' => $novel['cover'],
        ];
    }
}