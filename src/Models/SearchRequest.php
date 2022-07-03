<?php

declare(strict_types=1);

namespace Jarlskov\Untappd\Models;

class SearchRequest
{
    private string $breweryName;
    private string $beerName;

    public function getBeerName(): string
    {
        return $this->beerName;
    }

    public function getBreweryName(): string
    {
        return $this->breweryName;
    }

    public function hasBeerName(): bool
    {
        return isset($this->beerName);
    }

    public function hasBreweryName(): bool
    {
        return isset($this->breweryName);
    }

    public function setBeerName(string $name): void
    {
        $this->beerName = $name;
    }

    public function setBreweryName(string $name): void
    {
        $this->breweryName = $name;
    }
}
