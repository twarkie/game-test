<?php

namespace GameTest\Scraper;

use GameTest\Scraper\JsonScraper;

class RawgScraper extends JsonScraper
{
    protected $url = 'https://api.rawg.io/api/games';

    protected function formatResponse($response)
    {
        if (!$response->count) {
            return [];
        }

        $games = array_slice($response->results, $this->offset, $this->limit);

        $results = [];
        foreach ($games as $game) {
            array_push($results, (object) [
                'name' => $game->name,
                'rating' => $game->rating,
                'ratingTop' => $game->rating_top,
                'ratingsCount' => $game->ratings_count,
                'backgroundImage' => $game->background_image,
                'psStoreAvailability' => $this->availableInStore($game->stores, 'playstation-store')
            ]);
        }

        return $results;
    }

    private function availableInStore($stores, $storeSlug) {
        foreach ($stores as $store) {
            if ($store->store->slug == $storeSlug) {
                return true;
            }
        }

        return false;
    }
}
