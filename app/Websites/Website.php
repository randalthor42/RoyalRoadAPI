<?php
namespace App\Websites;

class Website
{
    private $name;
    private $url_pattern;

    public function __construct(string $name, string $url_pattern)
    {
        $this->name = $name;
        $this->url_pattern = $url_pattern;
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getUrlPattern(): string
    {
        return $this->url_pattern;
    }

}