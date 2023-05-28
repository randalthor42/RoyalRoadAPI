<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Str;
use Mockery;

class FictionApiTest extends TestCase
{
    use DatabaseTransactions;

    private $baseRoute = "/api/royalroad";
    private $fictionId = '26675';
    private $chapterId = '0';
    private $apiKey;

    public function setUp(): void
    {
        parent::setUp();
        //$apiKey = \App\Models\Api\ApiKey::factory()->create();
        $this->apiKey = env('TEST_API_KEY');
    }

    // Add a helper method to prepare the headers
    private function getHeaders()
    {
        return [
            'Accept' => 'application/json',
            'X-API-KEY' => $this->apiKey,
        ];
    }


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
        $response = $this->withHeaders($this->getHeaders())->get("{$this->baseRoute}/fiction/{$this->fictionId}");
        $response->assertStatus(200);
        $response->assertJsonStructure($this->getFictionJsonStructure());
    }

    public function testFetchingFictionWithIncludedChapters()
    {
        $response = $this->withHeaders($this->getHeaders())->get("{$this->baseRoute}/fiction/{$this->fictionId}?includes=chapters");
        $response->assertStatus(200);
        $response->assertJsonStructure($this->getFictionJsonStructure(true));
    }

    public function testFetchingFictionChapterWithInclude()
    {
        $response = $this->withHeaders($this->getHeaders())->get("{$this->baseRoute}/fiction/{$this->fictionId}?includes=chapters:{$this->chapterId}");
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
        $response = $this->withHeaders($this->getHeaders())->get("{$this->baseRoute}/fiction/{$this->fictionId}/chapters/{$this->chapterId}");
        $response = $this->get("{$this->baseRoute}/fiction/{$this->fictionId}/chapters/{$this->chapterId}");
        $response->assertStatus(200);
        $response->assertJsonStructure($this->getChapterJsonStructure());
    }

    public function testFetchingChapterList()
    {
        $response = $this->withHeaders($this->getHeaders())->get("{$this->baseRoute}/fiction/{$this->fictionId}/chapters");
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
        $response = $this->withHeaders($this->getHeaders())->get("{$this->baseRoute}/fiction/{$this->fictionId}/chapters/{$this->chapterId}");
        $response->assertStatus(200);
        $response->assertJsonStructure($this->getChapterJsonStructure());
    }
}
