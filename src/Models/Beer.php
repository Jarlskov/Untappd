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
        private float $ratingCount,
        private float $ratingScore,
        private Stats $stats,
        private Brewery $brewery
    ) {}
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
            $response->rating_count,
            $response->rating_score,
            Stats::fromUntappdResponse($response->stats),
            Brewery::fromUntappdResponse($response->brewery)
        );
    }
}
