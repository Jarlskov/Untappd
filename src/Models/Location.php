<?php

declare(strict_types=1);

namespace Jarlskov\Untappd\Models;

class Location
{
    private string $breweryCity;
    private string $breweryState;
    private float $lat;
    private float $lng;

    public static function fromUntappdResponse(\stdClass $response): self
    {
        $location = new self();
        $location->breweryCity = $response->brewery_city;
        $location->breweryState = $response->brewery_state;
        $location->lat = $response->lat;
        $location->lng = $response->lng;

        return $location;
    }
}
