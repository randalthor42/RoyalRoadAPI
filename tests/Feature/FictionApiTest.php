<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FictionApiTest extends TestCase
{
    /**
     * Test fetching a fiction without chapters included.
     *
     * @return void
     */
    public function testFetchingFiction()
    {
        $fictionId = '26675';
        $response = $this->get("/api/fiction/{$fictionId}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'title',
            'tags',
            'warnings',
            'description',
            'cover',
            'includes'
        ]);
    }

    /**
     * Test fetching a fiction with included chapters.
     *
     * @return void
     */
    public function testFetchingFictionWithIncludedChapters()
    {
        $fictionId = '26675';
        $response = $this->get("/api/fiction/{$fictionId}?includes=chapters");

        $response->assertStatus(200)->assertJsonStructure([
            'id',
            'title',
            'tags',
            'warnings',
            'description',
            'cover',
            'includes' => [
                'chapters' => [
                    '*' => [
                        'id',
                        'volumeId',
                        'title',
                        'date',
                        'url',
                    ],
                ],
            ],
        ]);
    }

    /**
     * Test fetching a specific fiction chapter with include.
     *
     * @return void
     */
    public function testFetchingFictionChapterWithInclude()
    {
        $fictionId = '26675';
        $chapterId = '0';
        $response = $this->get("/api/fiction/{$fictionId}?includes=chapter:{$chapterId}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'title',
            'tags',
            'warnings',
            'description',
            'cover',
            'includes' => [
                '*' => [
                    'id',
                    'volumeId',
                    'title',
                    'date',
                    'url',
                    'content'
                ]
            ]
        ]);
    }

    /**
     * Test fetching a specific fiction chapter.
     *
     * @return void
     */
    public function testFetchingSpecificFictionChapter()
    {
        $fictionId = '26675';
        $chapterId = '0';
        $response = $this->get("/api/fiction/{$fictionId}/chapters/{$chapterId}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'volumeId',
            'title',
            'date',
            'url',
            'content'
        ]);
    }
    
    /**
     * Test fetching the list of chapters for a fiction.
     *
     * @return void
     */
    public function testFetchingChapterList()
    {
        $fictionId = '26675';
        $response = $this->get("/api/fiction/{$fictionId}/chapters");

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'volumeId',
                    'title',
                    'date',
                    'url',
                ],
            ]);
    }

    /**
     * Test fetching the content of a specific chapter.
     *
     * @return void
     */
    public function testFetchingChapterContent()
    {
        $fictionId = '26675';
        $chapterId = '0';
        $response = $this->get("/api/fiction/{$fictionId}/chapters/{$chapterId}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'volumeId',
            'title',
            'date',
            'url',
            'content'
        ]);
    }
}
