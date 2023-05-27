<?php
namespace App\Parsers;

use App\Websites\Website;
use App\Websites\WebsiteContext;
use Illuminate\Http\Request;

class ParserRegistry
{
    private $parserFactory;
    private $website;

    public function __construct(ParserFactory $parserFactory, Website $website = null)
    {
        $this->parserFactory = $parserFactory;
        $this->website = $website;
    }

    public function setCurrentWebsite($website)
    {
        if (!$website instanceof Website) {
            throw new \InvalidArgumentException("Invalid website object provided");
        }
        $this->website = $website;
    }

    public function getParser(string $parserType): ParserInterface
    {
        if (!$this->website) {
            throw new \InvalidArgumentException("Website must be set before requesting a parser");
        }

        $websiteName = $this->website->getName();
        $websiteConfig = config('websites.'.$websiteName);
        $parserClass = $websiteConfig['parsers'][$parserType];

        return $this->parserFactory->make($parserClass);
    }

}

