<?php

namespace App\Transformers;

class FictionTransformer
{
    public function transform($fiction)
    {
        return [
            'id' => $fiction['id'],
            'title' => $fiction['title'],
            'tags' => $fiction['tags'],
            'description' => $fiction['description'],
            'cover' => $fiction['cover'],
        ];
    }
}