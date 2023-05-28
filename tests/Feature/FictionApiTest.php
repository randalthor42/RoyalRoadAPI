<?php

namespace Tests\Feature;

use Tests\TestCase;

class FictionApiTest extends TestCase
{
    private $baseRoute = "/api/royalroad";
    private $fictionId = '26675';
    private $chapterId = '0';

    private function getFictionJsonStructure(bool $includeChapters = false): array
    {
        $structure = [
            'id',
            'title',
            'tags',
            'warnings',
            'description',
            'cover',
            'includes'
        ];

        if ($includeChapters) {
            $structure['includes'] = [
                'chapters' => [
                    '*' => [
                        'id',
                        'volumeId',
                        'title',
                        'date',
                        'url',
                    ],
                ],
            ];
        }

        return $structure;
    }

    private function getChapterJsonStructure(): array
    {
        return [
            'id',
            'volumeId',
            'title',
            'date',
            'url',
            'content'
        ];
    }

    public function testFetchingFiction()
    {
        $response = $this->get("{$this->baseRoute}/fiction/{$this->fictionId}");

        $response->assertStatus(200);

        $response->assertJsonStructure($this->getFictionJsonStructure());
    }

    public function testFetchingFictionWithIncludedChapters()
    {
        $response = $this->get("{$this->baseRoute}/fiction/{$this->fictionId}?includes=chapters");

        $response->assertStatus(200);

        $response->assertJsonStructure($this->getFictionJsonStructure(true));
    }

    public function testFetchingFictionChapterWithInclude()
    {
        $response = $this->get("{$this->baseRoute}/fiction/{$this->fictionId}?includes=chapters:{$this->chapterId}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'title',
            'tags',
            'warnings',
            'description',
            'cover',
            'includes' => [
                '*' => $this->getChapterJsonStructure()
            ]
        ]);
    }

    public function testFetchingSpecificFictionChapter()
    {
        $response = $this->get("{$this->baseRoute}/fiction/{$this->fictionId}/chapters/{$this->chapterId}");

        $response->assertStatus(200);

        $response->assertJsonStructure($this->getChapterJsonStructure());
    }

    public function testFetchingChapterList()
    {
        $response = $this->get("{$this->baseRoute}/fiction/{$this->fictionId}/chapters");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'volumeId',
                'title',
                'date',
                'url',
            ],
        ]);
    }

    public function testFetchingChapterContent()
    {
        $response = $this->get("{$this->baseRoute}/fiction/{$this->fictionId}/chapters/{$this->chapterId}");

        $response->assertStatus(200);

        $response->assertJsonStructure($this->getChapterJsonStructure());
    }
}
