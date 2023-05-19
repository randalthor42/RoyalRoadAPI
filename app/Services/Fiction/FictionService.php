<?php

namespace App\Services\Fiction;

use App\Services\Chapter\ChapterServiceInterface;
use simplehtmldom\HtmlWeb;
use simplehtmldom\HtmlDocument;
use Exception;

class FictionService implements FictionServiceInterface
{
    /** @var HtmlWeb */
    protected $htmlWeb;

    /** @var ChapterServiceInterface */
    protected $chapterService;

    /** @var AuthorServiceInterface */
    protected $authorService;

    /**
     * FictionService constructor.
     *
     * @param HtmlWeb $htmlWeb
     * @param ChapterServiceInterface $chapterService
     */
    public function __construct(HtmlWeb $htmlWeb ,ChapterServiceInterface $chapterService)
    {
        $this->htmlWeb = $htmlWeb;
        $this->chapterService = $chapterService;
    }

    /**
     * Get Fiction and its related data based on the provided id and includes.
     * 
     * @param string $id
     * @param array $includes
     * @return array
     */
    public function getFiction($id, $includes = [])
    {
        $url = "https://www.royalroad.com/fiction/{$id}";
        $html = $this->loadUrl($url);

        return array_merge(
            $this->getFictionDetails($id, $html),
            $this->getIncludes($id, $html, $includes)
        );
    }

    /**
     * Extracts novel details from the HTML document
     * 
     * @param string $id
     * @param HtmlDocument $html
     * @return array
     */
    protected function getFictionDetails($id, HtmlDocument $html)
    {
        return [
            'id' => $id,
            'title' => $this->getTitle($html),
            'tags' => $this->getTags($html),
            'warnings' => $this->getWarnings($html),
            'description' => $this->getDescription($html),
            'cover' => $this->getCover($html),
        ];
    }

    /**
     * Fetch additional data (includes) based on provided includes parameter.
     * 
     * @param string $id
     * @param HtmlDocument $html
     * @param array $includes
     * @return array
     */
    protected function getIncludes($id, HtmlDocument $html, array $includes)
    {
        $results = [];
        $methods = [
            'chapters' => 'getFictionChapters',
            'author' => 'getAuthor',
        ];
    
        foreach ($includes as $include) {
            if (strpos($include, 'chapters:') === 0) {
                $chapterId = substr($include, strlen('chapters:'));
                $results['chapter'] = $this->getFictionChapter($id, $chapterId, $html);
            } elseif (isset($methods[$include])) {
                $results[$include] = $this->{$methods[$include]}($id, $html);
            }
        }
    
        return $results;
    }    

    /**
     * Load HTML document from a given URL
     * 
     * @param string $url
     * @return HtmlDocument
     */
    protected function loadUrl($url)
    {
        return $this->htmlWeb->load($url);
    }

    /**
     *  Extract title from the HTML document
     * 
     * @param HtmlDocument $html
     * @return string
     */
    protected function getTitle(HtmlDocument $html)
    {
        return $html->find('h1', 0)->text();
    }

    /**
     *  Extract the novel tags from the HTML document
     * 
     * @param HtmlDocument $html
     * @return array
     */
    protected function getTags(HtmlDocument $html)
    {
        $tagsElements = $html->find('.fiction-info .tags a');
        $tags = [];

        foreach ($tagsElements as $tagElement) {
            $tags[] = $tagElement->text();
        }

        return $tags;
    }

    /**
     *  Extract the warnings tags from the HTML document
     * 
     * @param HtmlDocument $html
     * @return array
     */
    protected function getWarnings(HtmlDocument $html)
    {
        $warningDetails = $html->find('.fiction-info div.text-center.font-red-sunglo strong:contains("Warning") ~ ul.list-inline li');
        $warnings = [];
        foreach ($warningDetails as $detail) {
            $warnings[] = $detail->text();
        }
        return $warnings;
    }

    /**
     *  Extract description from the HTML document
     * 
     * @param HtmlDocument $html
     * @return string
     */
    protected function getDescription(HtmlDocument $html)
    {
        $descriptionParagraphs = $html->find('.fiction-info .description .hidden-content p');
        $description = '';

        foreach ($descriptionParagraphs as $paragraph) {
            $description .= $paragraph->plaintext . "\n";
        }

        return trim($description);
    }

    /**
     * Extract cover image URL from the HTML document
     * 
     * @param HtmlDocument $html
     * @return string
     */
    protected function getCover(HtmlDocument $html)
    {
        return $html->find('.cover-art-container img', 0)->src;
    }

    /**
     * Fetch the author details for a novel
     * 
     * @param string $id
     * @param HtmlDocument $html
     * @return array
     */
    protected function getAuthor($id, HtmlDocument $html)
    {
        if ($this->authorService === null) {
            throw new Exception("AuthorService is not set.");
        }

        return $this->authorService->getAuthor($id);
    }

    /**
     * Fetch all chapters of a fiction
     * 
     * @param string $fictionId
     * @return array
     */
    public function getFictionChapters($fictionId, $html = null)
    {
        return $this->chapterService->getChapters($fictionId);
    }

    /**
     * Fetch a specific chapter of a fiction.
     *  
     * @param string $fictionId
     * @return array
     */
    public function getFictionChapter($fictionId, $chapterId, $html = null)
    {
        return $this->chapterService->getChapter($fictionId, $chapterId);
    }


}
