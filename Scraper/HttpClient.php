<?php

namespace GameTest\Scraper;

class HttpClient
{
    private $curl;

    public function get($url)
    {
        return $this->call($url);
    }

    private function call($url)
    {
        $this->curl = curl_init();

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->curl);

        curl_close($this->curl);

        return $response;
    }
}
