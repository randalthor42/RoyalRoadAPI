<?php

namespace App\Websites;

use Exception;

class WebsiteManager
{
    private $websites = [];

    public function __construct()
    {
        $websiteConfigs = config('websites');
        foreach ($websiteConfigs as $name => $websiteConfig) {
            $this->websites[$name] = new Website($name, $websiteConfig['url_pattern']);
        }
    }

    public function getWebsite(string $name): Website
    {
        if (!isset($this->websites[$name])) {
            throw new Exception("Website '$name' does not exist.");
        }
        return $this->websites[$name];
    }

    public function getAllWebsites(): array
    {
        return $this->websites;
    }
}
