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

    public function getBreweryId(): int
    {
        return $this->breweryId;
    }

    public function getBreweryName(): string
    {
        return $this->breweryName;
    }

    public function getBreweryType(): string
    {
        return $this->breweryType;
    }

    public function getBrewerySlug(): string
    {
        return $this->brewerySlug;
    }

    public function getBreweryPageUrl(): string
    {
        return $this->breweryPageUrl;
    }

    public function getBreweryLabel(): string
    {
        return $this->breweryLabel;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

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
