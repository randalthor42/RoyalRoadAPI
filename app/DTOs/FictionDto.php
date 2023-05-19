<?php
namespace App\DTOs;

use JsonSerializable;

class FictionDto implements JsonSerializable
{
    private $id;
    private $title;
    private $tags;
    private $warnings;
    private $description;
    private $cover;
    private $includes;

    public function __construct(string $id, string $title, array $tags, array $warnings, string $description, string $cover, array $includes)
    {
        $this->id = $id;
        $this->title = $title;
        $this->tags = $tags;
        $this->warnings = $warnings;
        $this->description = $description;
        $this->cover = $cover;
        $this->includes = $includes;
    }
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getWarnings(): array
    {
        return $this->warnings;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCover(): string
    {
        return $this->cover;
    }

    public function getIncludes(): array
    {
        return $this->includes;
    }
}
