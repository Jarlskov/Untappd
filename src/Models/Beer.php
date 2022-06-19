<?php

declare(strict_types=1);

namespace Jarlskov\Untappd\Models;

class Beer
{
    private function __construct(private int $bid,
        private string $beerName,
        private string $beerLabel,
        private string $beerLabelHd,
        private float $beerAbv,
        private float $beerIbu,
        private string $beerDescription,
        private string $beerStyle,
        private bool $isInProduction,
        private string $beerSlug,
        private bool $isHomebrew,
        private int $ratingCount,
        private float $ratingScore,
        private Stats $stats,
        private Brewery $brewery
    ) {}

    public function getBid(): int
    {
        return $this->bid;
    }

    public function getBeerName(): string
    {
        return $this->beerName();
    }

    public function getBeerLabel(): string
    {
        return $this->beerLabel;
    }

    public function getBeerLabelHd(): string
    {
        return $this->beerLabelHd;
    }

    public function getBeerAbv(): float
    {
        return $this->beerAbv();
    }

    public function getBeerIbu(): float
    {
        return $this->beerIbu();
    }

    public function getBeerDescription(): string
    {
        return $this->beerDescription;
    }

    public function getBeerStyle(): string
    {
        return $this->beerStyle;
    }

    public function getBeerSlug(): string
    {
        return $this->beerSlug();
    }

    public function isHomebrew(): bool
    {
        return $this->isHomebrew;
    }

    public function getRatingCount(): int
    {
        return $this->ratingCount;
    }

    public function getRatingScore(): float
    {
        return $this->ratingScore;
    }

    public function getStats(): Stats
    {
        return $this->stats;
    }

    public function getBrewery(): Brewery
    {
        return $this->brewery;
    }

    public static function fromUntappdResponse(\stdClass $response): self
    {
        return new self(
            $response->bid,
            $response->beer_name,
            $response->beer_label,
            $response->beer_label_hd,
            $response->beer_abv,
            $response->beer_ibu,
            $response->beer_description,
            $response->beer_style,
            (bool) $response->is_in_production,
            $response->beer_slug,
            (bool) $response->is_homebrew,
            (int) $response->rating_count,
            $response->rating_score,
            Stats::fromUntappdResponse($response->stats),
            Brewery::fromUntappdResponse($response->brewery)
        );
    }
}
