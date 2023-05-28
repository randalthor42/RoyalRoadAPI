<?php
namespace Tests\Unit;

use App\Websites\WebsiteContext;
use App\Websites\WebsiteManager;
use Tests\TestCase;

class WebsiteContextTest extends TestCase
{
    public function test_set_and_get_website()
    {
        $websiteManager = new WebsiteManager();
        $websiteContext = new WebsiteContext();
        $websiteContext->setWebsite($websiteManager->getWebsite('royalroad'));;
        $this->assertEquals('royalroad', $websiteContext->getWebsite()->getName());
    }
}
