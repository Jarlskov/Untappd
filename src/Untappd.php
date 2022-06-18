<?php

declare(strict_types=1);

namespace Jarlskov\Untappd;

use GuzzleHttp\Client as GuzzleClient;
use Jarlskov\Untappd\Models\Beer;
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

    private function doRequest(string $url): Response
    {
        $params = [
            'query' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ],
        ];

        return $this->guzzle->get($this->baseUrl . $url, $params);
    }
}
