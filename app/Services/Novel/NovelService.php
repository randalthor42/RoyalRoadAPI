<?php

namespace App\Services\Novel;

use simplehtmldom\HtmlWeb;

class NovelService implements NovelServiceInterface
{
    protected $htmlWeb;

    public function __construct(HtmlWeb $htmlWeb)
    {
        $this->htmlWeb = $htmlWeb;
    }

    public function getNovel($id)
    {
        $url = "https://www.royalroad.com/fiction/{$id}";

        // Load the webpage
        $html = $this->loadUrl($url);

        // Get the title
        $title = $html->find('h1', 0)->text();

        // Get the author and author link
        $author = $html->find('h4 span a', 0);
        $authorName = $author->text();
        $authorLink = $author->href;


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

        return [
            'id' => $id,
            'title' => $title,
            'author' => $authorName,
            'author_link' => $authorLink,
            'tags' => $tags,
            'description' => $description,
        ];
    }

    protected function loadUrl($url)
    {
        return $this->htmlWeb->load($url);
    }
}
