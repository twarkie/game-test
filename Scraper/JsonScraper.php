<?php

namespace GameTest\Scraper;

use GameTest\Scraper\HttpClient;

class JsonScraper
{
    protected $limit = 10;
    protected $offset = 0;

    public function get() : array
    {
        $httpClient = new HttpClient;

        $response = $httpClient->get($this->url);

        return $this->formatResponse(json_decode($response));
    }

    public function setLimit(int $limit) : object
    {
        $this->limit = $limit;

        return $this;
    }

    public function setOffset(int $offset) : object
    {
        $this->offset = $offset;

        return $this;
    }
}
