<?php

namespace App\Websites;

use App\Websites\Website;

class WebsiteContext
{
    private $website;

    public function setWebsite(Website $website): void
    {
        $this->website = $website;
    }

    public function getWebsite(): ?Website
    {
        return $this->website;
    }
}
