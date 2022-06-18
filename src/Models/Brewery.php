<?php

declare(strict_types=1);

namespace Jarlskov\Untappd\Models;

class Brewery
{
    private function __construct(
        private int $breweryId,
        private string $breweryName,
        private string $breweryType,
        private string $brewerySlug,
        private string $breweryPageUrl,
        private string $breweryLabel,
        private string $countryName,
        private Contact $contact,
        private Location $location
    ) { }

    public static function fromUntappdResponse(\stdClass $response): self
    {
        return new self($response->brewery_id,
            $response->brewery_name,
            $response->brewery_type,
            $response->brewery_slug,
            $response->brewery_page_url,
            $response->brewery_label,
            $response->country_name,
            Contact::fromUntappdResponse($response->contact),
            Location::fromUntappdResponse($response->location)
        );
    }
}
