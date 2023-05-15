<?php

namespace App\Services\Novel;

use App\Services\Chapter\ChapterServiceInterface;
use simplehtmldom\HtmlWeb;

class NovelService implements NovelServiceInterface
{
    protected $htmlWeb;
    protected $chapterService;

    public function __construct(HtmlWeb $htmlWeb ,ChapterServiceInterface $chapterService)
    {
        $this->htmlWeb = $htmlWeb;
        $this->chapterService = $chapterService;
    }

    public function getNovel($id, $includes = [])
    {
        $url = "https://www.royalroad.com/fiction/{$id}";

        // Load the webpage
        $html = $this->loadUrl($url);
        
        // Get the title
        $title = $html->find('h1', 0)->text();

        // Get the tags
        $tagsElements = $html->find('.fiction-info .tags a');
        $tags = [];
        foreach ($tagsElements as $tagElement) {
            $tags[] = $tagElement->text();
        }

        // Get the description
        $descriptionParagraphs = $html->find('.fiction-info .description .hidden-content p');
        $description = '';
        foreach ($descriptionParagraphs as $paragraph) {
            $description .= $paragraph->plaintext . "\n";
        }

        $description = trim($description);

        //Get image
        $imageLink = $html->find('.cover-art-container img', 0)->src;

        $novel = [
            'id' => $id,
            'title' => $title,
            'tags' => $tags,
            'description' => $description,
            'cover' => $imageLink,
        ];
        foreach ($includes as $include) {
            if (method_exists($this, $include)) {
                $novel[$include] = $this->$include($id);
            }
        }

        return $novel;
    }

    protected function loadUrl($url)
    {
        return $this->htmlWeb->load($url);
    }

    protected function chapters($id)
    {
        return $this->chapterService->getChapters($id);
    }
}
