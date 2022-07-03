<?php

declare(strict_types=1);

namespace Jarlskov\Untappd;

use GuzzleHttp\Client as GuzzleClient;
use Jarlskov\Untappd\Models\Beer;
use Jarlskov\Untappd\Models\SearchRequest;
use Psr\Http\Message\ResponseInterface as Response;

class Untappd
{
    private GuzzleClient $guzzle;
    private string $baseUrl = 'https://api.untappd.com/v4/';

    public function __construct(private readonly string $clientId,
        private readonly string $clientSecret) 
    {
        $this->guzzle = new GuzzleClient();
    }

    public function getBeer(int $id): Beer
    {
        $result = $this->doRequest('beer/info/' . $id);

        return Beer::fromUntappdResponse(json_decode((string) $result->getBody())->response->beer);
    }

    public function beerSearch(SearchRequest $request): array
    {
        $query = '';
        if ($request->hasBreweryName()) {
            $query .= $request->getBreweryName() . ' ';
        }
        if ($request->hasBeerName()) {
            $query .= $request->getBeerName();
        }

        $result = $this->doRequest('search/beer', ['query' => ['q' => $query]]);

        $searchResult = json_decode((string) $result->getBody())->response->beers->items;
        $beers = [];
        foreach ($searchResult as $r) {
            $beers[] = Beer::fromUntappdResponse($r->beer, $r->brewery);
        }

        return $beers;
    }

    private function doRequest(string $url, array $options = []): Response
    {
        $params = [
            'query' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ],
        ];

        $params = array_merge_recursive($params, $options);

        return $this->guzzle->get($this->baseUrl . $url, $params);
    }
}
